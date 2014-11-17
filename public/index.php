<?php

error_reporting(E_ALL);

function P($path){return str_replace('\\','/',$path);}
define('WEB_ROOT',str_replace(P($_SERVER['SCRIPT_NAME']),'',P(dirname(dirname(__FILE__))).'/index.php').'/');
define('HOST', 'http://'.$_SERVER['HTTP_HOST'].'/');
define('DATA_BASIC_PATH', P(dirname(dirname(__FILE__))).'/data');
define('BASIC_PATH',    P(dirname(dirname(__FILE__))).'/');
define('STATIC_PATH',"./static/");//静态文件目录

define('UPLOAD_FILE',"file/");

date_default_timezone_set('Asia/Shanghai');	// 上海时区

try {

	/**
	 *	读取配置文件
	 */
	$config = new Phalcon\Config\Adapter\Ini(__DIR__ . '/../app/config/config.ini');


	/**
	 *	注册一些目录，用于存放应用的类文件
	 */
	$loader = new \Phalcon\Loader();

	$loader->registerDirs(array(
		__DIR__ . $config->application->controllersDir,
		__DIR__ . $config->application->pluginsDir,
		__DIR__ . $config->application->libraryDir,
		__DIR__ . $config->application->modelsDir,
	))->register();


	/**
	 *	批量注册组件
	 */
	$di = new \Phalcon\DI\FactoryDefault();
	

	/**
	 *	注册分发器（Dispatcher）
	 */
	$di->set('dispatcher', function() use ($di) {

		$eventsManager = $di->getShared('eventsManager');

		$security = new Security($di);

		// 使用安全性插件监听时间调度器
		$eventsManager->attach('dispatch', $security);

		$dispatcher = new Phalcon\Mvc\Dispatcher();
		$dispatcher->setEventsManager($eventsManager);

		return $dispatcher;
	});


	/**
	 *	URL组件，用于生成应用程序中所有的url
	 */
	$di->set('url', function() use ($config) {
		$url = new \Phalcon\Mvc\Url();
		$url->setBaseUri($config->application->baseUri);

		return $url;
	});


	/**
	 *	设置View模块
	 */
	$di->set('view', function() use ($config) {

		$view = new \Phalcon\Mvc\View();
		$view->setViewsDir(__DIR__ . $config->application->viewsDir);
		$view->registerEngines(array(
			'.volt' => 'volt'
		));

		return $view;
	});


	/**
	 *	设置volt
	 */
	$di->set('volt', function($view, $di) {

		$volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);
		$volt->setOptions(array(
// 			'compiledPath' => '../cache/volt/'
		));

		return $volt;
	}, true);


	/**
	 *	设置数据库连接
	 */
	$di->set('db', function() use ($config) {
		
		$conn = new \Phalcon\Db\Adapter\Pdo\Mysql(array(
			"host" => $config->database->host,
			"username" => $config->database->username,
			"password" => $config->database->password,
			"dbname" => $config->database->dbname,
			"charset" => 'utf8', // 在php 5.3.6之前无效
		));
		$conn->query("set names utf8");	// 变通解决办法
		
		return $conn;
	});
	
	
	/**
	 *	 If the configuration specify the use of metadata adapter use it or use memory otherwise
	 */
	$di->set('modelsMetadata', function() use ($config) {
		if (isset($config->models->metadata)) {
			$metaDataConfig = $config->models->metadata;
			$metadataAdapter = 'Phalcon\Mvc\Model\Metadata\\'.$metaDataConfig->adapter;

			return new $metadataAdapter();
		}

		return new Phalcon\Mvc\Model\Metadata\Memory();
	});


	/**
	 * Start the session the first time some component request the session service
	 */
	$di->set('session', function() {
		$session = new Phalcon\Session\Adapter\Files();
		$session->start();

		return $session;
	});
	
	$di->set('cookies', function() {
		$cookies = new Phalcon\Http\Response\Cookies();
		$cookies->useEncryption(false);
		return $cookies;
	});

	/**
	 * Register the flash service with custom CSS classes
	 */
	$di->set('flash', function() {
		return new Phalcon\Flash\Direct(array(
			'error' => 'alert alert-error',
			'success' => 'alert alert-success',
			'notice' => 'alert alert-info',
		));
	});


	/**
	 * Register a user component
	 */
	$di->set('elements', function(){

		return new Elements();
	});
	
	/**
	 * 注册基本方法组件
	 */
	
	$di->set('rbac',function(){
		return new Rbac();
	});
		
	$di->set('util', function(){
		
		return new Util();
	});
	
	$di->set('file', function(){
		
		return new File();
	});
	
	$di->set('common', function(){
		
		return new Common();
	});
	
	$di->set('history', function(){
		
		return new History();
	});
	
	$di->set('imagethumb', function(){
		
		return new Imagethumb();
	});
	
	$di->set('web', function(){
		
		return new Web();
	});
	
	$di->set('commoncircle',function(){
		return new CommonCircle();
	});
	
	$di->set('upfile',function(){
			return new Upfile();
	});
	$di->set('phpzip',function(){
		   return new PHPZip();
	});

	/**_
	 *	初始化类并执行用户的请求
	 */
	$application = new \Phalcon\Mvc\Application();
	$application->setDI($di);
	echo $application->handle()->getContent();

} catch (Phalcon\Exception $e) {
	echo $e->getMessage();
} catch (PDOException $e) {
	echo $e->getMessage();
}

?>
