<?php

use Phalcon\Tag as Tag;

class SessionController extends ControllerBase
{
    public function initialize()
    {
		// $this->view->setTemplateAfter('main');	// 框架通用菜单
    	$config = new Phalcon\Config\Adapter\Ini(__DIR__.'/../config/config.ini');
    	$this->session->set('object_name', $config->object->object_name);
        parent::initialize();
    }

    public function indexAction()
    {
		Tag::setTitle($this->session->get('object_name').' | 登陆');
    }

    public function registerAction()
    {
    	$this->view->setTemplateAfter('topbar');	// 框架通用菜单
    	Tag::setTitle($this->session->get('object_name').' | 注册');
        $request = $this->request;
        
        if ($request->isPost()) {

            $name = $request->getPost('name', array('string', 'striptags'));
            $username = $request->getPost('username', 'alphanum');
            $email = $request->getPost('email', 'email');
            $password = $request->getPost('password');
            $repeatPassword = $request->getPost('repassword');

            if ($password != $repeatPassword) {
                $this->flash->error('Passwords are diferent');
                return false;
            }
			
            // 保存用户数据到数据库
            $user = new Users();
            $user->username = $username;
            $user->password = $password;
            $user->name = $name;
            $user->email = $email;
            $user->status = '0';
            date_default_timezone_set('Asia/Shanghai');	// 上海时区
            $user->created = time();
			
            if ($user->save() == false) {
                foreach ($user->getMessages() as $message) {
            		$this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
                }
            } else {
            	// 保存用户角色到数据库
            	$userRole = new UserRole();
            	$userRole->userid = $user->readAttribute('userid');	// 获取user插入id
            	$userRole->roleid = '2';	// 普通用户
            	$userRole->created = time();
            	
            	if ($userRole->save() == false) {
            		foreach ($userRole->getMessages() as $message) {
            			$this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
            		}
            	}
            	
            	$user->roleid = '2';
            	
            	$userInfo['userid'] = $userRole->userid;
            	$userInfo['username'] = $user->username;
            	$userInfo['dirPath'] = DATA_BASIC_PATH.'/'.$userRole->userid;
            	$this->_registerSession((object)$userInfo);
            	
            	// 创建用户初始化跟目录 
            	$this->_pathAllow($userInfo['dirPath']);
            	mkdir($userInfo['dirPath'], 0777);
            	chmod($userInfo['dirPath'], 0777);
            	mkdir($userInfo['dirPath'].'/private', 0777);
            	chmod($userInfo['dirPath'].'/private', 0777);
            	mkdir($userInfo['dirPath'].'/public', 0777);
            	chmod($userInfo['dirPath'].'/public', 0777);
            	
            	date_default_timezone_set('Asia/Shanghai');	// 上海时区
            	$createtime = time();
            	            	
            	$gLocalfileManage = new GLocalfileManage();
            	$gLocalfileManage->userid = $userInfo['userid'];
            	$gLocalfileManage->name = '我的G盘';
            	$gLocalfileManage->tags = '我的G盘';
            	$gLocalfileManage->size = 0;
            	$gLocalfileManage->type = 'folder';
            	$gLocalfileManage->local = $userInfo['dirPath'].'/private';
            	$gLocalfileManage->url = $userInfo['dirPath'].'/private';
            	$gLocalfileManage->status = 0;
            	$gLocalfileManage->modifytime = $createtime;
            	$gLocalfileManage->createtime = $createtime;
            	
            	if ($gLocalfileManage->save() == false) {
            			
            		foreach ($gLocalfileManage->getMessages() as $message) {
            			$this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
            		}
            	}
            	
            	$gCloudfileManage = new GCloudfileManage();
            	$gCloudfileManage->parenturl = '';
            	$gCloudfileManage->name = '我的G盘';
            	$gCloudfileManage->oldurl = $userInfo['dirPath'].'/private/';
            	$gCloudfileManage->url = $userInfo['dirPath'].'/private/';
            	$gCloudfileManage->fileid = $gLocalfileManage->readAttribute('fileid');
            	$gCloudfileManage->userid = $userInfo['userid'];
            	$gCloudfileManage->ext = '';
            	$gCloudfileManage->type = 'folder';
            	$gCloudfileManage->accesstimes = 1;
            	$gCloudfileManage->isencryption = 0;
            	$gCloudfileManage->isreadable = 1;
            	$gCloudfileManage->iswriteable = 1;
            	$gCloudfileManage->size = 0;
            	$gCloudfileManage->sizefriendly = '0 B';
            	$gCloudfileManage->status = 0;
            	$gCloudfileManage->lastaccesstime = $createtime;
            	$gCloudfileManage->modifytime = $createtime;
            	$gCloudfileManage->createtime = $createtime;
            	
            	if ($gCloudfileManage->save() == false) {
            		foreach ($gCloudfileManage->getMessages() as $message) {
            			$this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
            		}
            	}
            	
            	$logs = new Logs();
            	$logs->userid = $userInfo['userid'];
            	$logs->description = '新建文件夹'.$filename;
            	$logs->gcloudid = $gCloudfileManage->readAttribute('gcloudid');
            	$logs->ipaddress = $this->common->get_client_ip();
            	$logs->createtime = $createtime;
            	
            	if ($logs->save() == false) {
            		foreach ($logs->getMessages() as $message) {
            			$this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
            		}
            	}
            	
            	$gLocalfileManage = new GLocalfileManage();
            	$gLocalfileManage->userid = $userInfo['userid'];
            	$gLocalfileManage->name = '我收到的分享';
            	$gLocalfileManage->tags = '我收到的分享';
            	$gLocalfileManage->size = 0;
            	$gLocalfileManage->type = 'folder';
            	$gLocalfileManage->local = $userInfo['dirPath'].'/public';
            	$gLocalfileManage->url = $userInfo['dirPath'].'/public';
            	$gLocalfileManage->status = 0;
            	$gLocalfileManage->modifytime = $createtime;
            	$gLocalfileManage->createtime = $createtime;
            	 
            	if ($gLocalfileManage->save() == false) {
            		 
            		foreach ($gLocalfileManage->getMessages() as $message) {
            			$this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
            		}
            	}
            	 
            	$gCloudfileManage = new GCloudfileManage();
            	$gCloudfileManage->parenturl = '';
            	$gCloudfileManage->name = '我收到的分享';
            	$gCloudfileManage->oldurl = $userInfo['dirPath'].'/public/';
            	$gCloudfileManage->url = $userInfo['dirPath'].'/public/';
            	$gCloudfileManage->fileid = $gLocalfileManage->readAttribute('fileid');
            	$gCloudfileManage->userid = $userInfo['userid'];
            	$gCloudfileManage->ext = '';
            	$gCloudfileManage->type = 'folder';
            	$gCloudfileManage->accesstimes = 1;
            	$gCloudfileManage->isencryption = 0;
            	$gCloudfileManage->isreadable = 1;
            	$gCloudfileManage->iswriteable = 1;
            	$gCloudfileManage->size = 0;
            	$gCloudfileManage->sizefriendly = '0 B';
            	$gCloudfileManage->status = 0;
            	$gCloudfileManage->lastaccesstime = $createtime;
            	$gCloudfileManage->modifytime = $createtime;
            	$gCloudfileManage->createtime = $createtime;
            	 
            	if ($gCloudfileManage->save() == false) {
            		foreach ($gCloudfileManage->getMessages() as $message) {
            			$this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
            		}
            	}
            	 
            	$logs = new Logs();
            	$logs->userid = $userInfo['userid'];
            	$logs->description = '新建文件夹'.$filename;
            	$logs->gcloudid = $gCloudfileManage->readAttribute('gcloudid');
            	$logs->ipaddress = $this->common->get_client_ip();
            	$logs->createtime = $createtime;
            	 
            	if ($logs->save() == false) {
            		foreach ($logs->getMessages() as $message) {
            			$this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
            		}
            	}
            	
 				$this->flash->success('欢迎 '. $user->username);
 				$this->view->setVar('controllerName', 'session');
 				return $this->forward('index/index');
            }
        }
    }
    
    public function _pathAllow($path) {
    	$name = $this->file->get_path_this($path);
    	$path_not_allow  = array('*','?','"','<','>','|');
    	foreach ($path_not_allow as $tip) {
    		if (strstr($name,$tip)) {
    			$this->common->show_json("文件名不允许存在*,?,<,>,|",false);
    		}
    	}
    }

    /**
     * Register authenticated user into session data
     *
     * @param Users $user
     */
    private function _registerSession($user)
    {
        $this->session->set('auth', array(
            'userid' => $user->userid,
            'username' => $user->username,
        	'roleids' => $user->roleid
        ));
        $this->session->set('gDiskPath', DATA_BASIC_PATH.'/'.$user->userid.'/private/');
        $this->session->set('shareDiskPath', DATA_BASIC_PATH.'/'.$user->userid.'/public/');
    }

    /**
     * This actions receive the input from the login form
     *
     */
    public function startAction()
    {
    	if ($this->request->isPost()) {
    		
    		// 多表联查
			$username = $this->request->getPost('username');
			$password = $this->request->getPost('password');

			$user = Users::findFirst("username='$username' AND password='$password' AND status=0");
			if ($user != false) {
				foreach ($user->getUserRole() as $userRole) {
					$user->roleid = $userRole->getRole()->id;
				}
				$this->_registerSession($user);
				$this->flash->success('登陆成功 ' . $user->name);
				$this->view->setVar('controllerName', 'session');
				return $this->forward('index/index');
			}
			
			Tag::setDefault('username', $username);	
			$this->flash->error('用户名或密码错误！');
    	}
		
		return $this->forward('session/index');
    }

    /**
     * Finishes the active session redirecting to the index
     *
     * @return unknown
     */
    public function endAction()
    {
        $this->session->remove('auth');
        $this->flash->success('Goodbye!');
        return $this->forward('session/index');
    }
}
