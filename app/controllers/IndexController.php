<?php

use Phalcon\Tag as Tag;

class IndexController extends ControllerBase
{	
    public function initialize()
    {
    	$config = new Phalcon\Config\Adapter\Ini(__DIR__.'/../config/config.ini');
    	$this->session->set('object_name', $config->object->object_name);
		    	    	
        parent::initialize();
    }

    public function indexAction()
    {
    	if (!$this->session->get('auth')) {
    		return $this->forward('session/index');
    	}
    	$this->view->setTemplateAfter('topbar');	// 框架通用菜单
    	
    	Tag::setTitle($this->session->get('object_name').' | 首页');
    }
    
    public function treeListAction($app, $type='') { // 树结构
		
    	if (isset($type) && $type=='init'){
    		$this->_tree_init($app);
    	}
    	
    	// 查询根路径
   		$request = $this->request;
    	if ($request->isPost() == true) {
    		$path = $request->getPost('path');
    		$filename = $request->getPost('name');
    		$this_path = $request->getPost('this_path');
    	}
    	
    	if ($path != 'undefined') {
    		$this_path = urldecode($path).$filename.'/';
    	}
    	
    	$conditions = "parenturl = :parenturl: AND status = 0";
		
    	$parameters = array(
    			"parenturl" => $this_path
    	);

    	$gCloudfileManage = GCloudfileManage::find(array(
    			$conditions,
    			'bind' => $parameters
    	));
		
    	$list['folderlist'] = array();
    	$list['filelist'] = array();
    	foreach ($gCloudfileManage as $userFile) {
    		
    		$temp['name'] = $userFile->name;
    		$temp['path'] = $userFile->parenturl;
    		$temp['type'] = $userFile->type;
    		$temp['mode'] = $userFile->type == 'folder' ? 'drwx rwx rwx' : '-rw- r-- r--';
    		$temp['atime'] = $userFile->lastaccesstime;
    		$temp['ctime'] = $userFile->createtime;
    		$temp['mtime'] = $userFile->modifytime;
    		$temp['is_readable'] = $userFile->isreadable;
    		$temp['is_writeable'] = $userFile->iswriteable;
    		$temp['isParent'] =  $this->isParent($userFile->url);
    		
    		if ($userFile->type == 'folder') {
    			$list['folderlist'][] = $temp;
    		}
    		else {
    			$list['filelist'][] = $temp;
    		}
    	}
		
		$this->common->show_json($list['folderlist'], true);
	}
    
    private function isParent($path) {

    	$gCloudfileManage = GCloudfileManage::findFirst("parenturl = '$path'");

    	return $gCloudfileManage ? 1 : 0;
    }
    
    private function _tree_init($app) {
   		
    	$check_file = ($app == 'editor'?true:false);
		
    	// 查询根路径
    	$this_path = $this->session->get('gDiskPath');
    	$conditions = "parenturl = :parenturl: AND status = 0";
		    	 
    	$parameters = array(
    		"parenturl" => $this_path
		);
    	$gCloudfileManage = GCloudfileManage::find(array(
    		$conditions,
    		'bind' => $parameters
    	));
    	$list_root['folderlist'] = array();
    	$list_root['filelist'] = array();
		foreach ($gCloudfileManage as $userFile) {
    		
    		$temp['name'] = $userFile->name;
    		$temp['path'] = $userFile->parenturl;
    		$temp['type'] = $userFile->type;
    		$temp['mode'] = $userFile->type == 'folder' ? 'drwx rwx rwx' : '-rw- r-- r--';
    		$temp['atime'] = $userFile->lastaccesstime;
    		$temp['ctime'] = $userFile->createtime;
    		$temp['mtime'] = $userFile->modifytime;
    		$temp['is_readable'] = $userFile->isreadable;
    		$temp['is_writeable'] = $userFile->iswriteable;
    		$temp['isParent'] =  $this->isParent($userFile->url);
    		
    		if ($userFile->type == 'folder') {
    			$list_root['folderlist'][] = $temp;
    		}
    		else {
    			$list_root['filelist'][] = $temp;
    		}
    	}
    	
    	// 查询分享路径
    	$share_path = $this->session->get('shareDiskPath');
    	$conditions = "parenturl = :parenturl: AND status = 0";
		    	 
    	$parameters = array(
    		"parenturl" => $share_path
		);
    	$shareCloudfileManage = GCloudfileManage::find(array(
    		$conditions,
    		'bind' => $parameters
    	));
    	$list_share['folderlist'] = array();
    	$list_share['filelist'] = array();
    	foreach ($shareCloudfileManage as $userFile) {
    		
    		$temp['name'] = $userFile->name;
    		$temp['path'] = $userFile->parenturl;
    		$temp['type'] = $userFile->type;
    		$temp['mode'] = $userFile->type == 'folder' ? 'drwx rwx rwx' : '-rw- r-- r--';
    		$temp['atime'] = $userFile->lastaccesstime;
    		$temp['ctime'] = $userFile->createtime;
    		$temp['mtime'] = $userFile->modifytime;
    		$temp['is_readable'] = $userFile->isreadable;
    		$temp['is_writeable'] = $userFile->iswriteable;
    		$temp['isParent'] =  $this->isParent($userFile->name);
    		
    		if ($userFile->type == 'folder') {
    			$list_share['folderlist'][] = $temp;
    		}
    		else {
    			$list_share['filelist'][] = $temp;
    		}
    	}
    
    	if ($check_file) {//编辑器
    		$root = array_merge($list_root['folderlist'], $list_root['filelist']);
    		
    		$share = array_merge($list_share['folderlist'], $list_share['filelist']);
    		$root_isparent = count($root)>0?true:false;
    		$share_isparent = count($share)>0?true:false;
    		
    		$tree_data = array(
    			array(
    				'name'=>'我的G盘',
    				'ext'=>'__root__',
    				'children'=>$root,
    				'iconSkin'=>"my",
    				'open'=>true,
    				'this_path'=> $this->session->get('gDiskPath'),		// Todo: 个人文件夹目录
    				'isParent'=>$root_isparent
    			),
    			array(
    				'name'=>'我收到的分享',
    				'ext'=>'__root__',
    				'children'=>$share,
    				'iconSkin'=>"lib",
    				'open'=>true,
    				'this_path'=> $this->session->get('shareDiskPath'),	// Todo: 个人收到分享文件夹目录
    				'isParent'=>$share_isparent
    			)
    		);
    	}
    	else {	// 文件管理器
    		$root  = $list_root['folderlist'];
    		$share = $list_share['folderlist'];
    		$root_isparent = count($root)>0?true:false;
    		$share_isparent = count($share)>0?true:false;
    		
    		$tree_data = array(
    			array(
    				'name'=>'我的G盘',
    				'ext'=>'__root__',
    				'children'=>$root,
    				'iconSkin'=>"my",
    				'open'=>true,
    				'this_path'=> $this->session->get('gDiskPath'),		// Todo: 个人文件夹目录
    				'isParent'=>$root_isparent
    			),
    			array(
    				'name'=>'我收到的分享',
    				'ext'=>'__root__',
    				'children'=>$share,
    				'iconSkin'=>"lib",
    				'open'=>true,
    				'this_path'=> $this->session->get('shareDiskPath'),	// Todo: 个人收到分享文件夹目录
    				'isParent'=>$share_isparent
    			)
    		);
    	}
		
    	$this->common->show_json($tree_data);
    }
    
    public function pathListAction() {
		
    	$actionList = array('video' );
    	
//     	$session = $this->session->get('history') ? $this->session->get('history') : false;
    	
    	$request = $this->request;
    	if ($request->isGet() == true) {
    		$user_path	= $request->get('this_path');
    		$task		= $request->get('task');
    		$action		= $request->get('action');
    	}
    	
    	if ($task) {
    		$filenameExtension = FilenameExtension::find("category = '$action'");
    		
    		$conditions = '';
    		foreach ($filenameExtension as $key=>$value) {
    			if (!empty($conditions)) {
    				$conditions .= ' or ';
    			}
    			$conditions .= "ext = '$value->name' AND status = 0";
    		}
    		
    		$gCloudfileManage = GCloudfileManage::find($conditions);
    	}
    	else {
    		
    		$this->session->set('this_path', $user_path);
    		/*
    		 // Todo: 历史记录需要处理
    		if (is_array($session)){
    		
    		$hi=new History($session);
    		if ($user_path==""){
    		$user_path=$hi->getFirst();
    		}else {
    		$hi->add($user_path);
    		$this->session->set('history', $hi->getHistory());
    		}
    		
    		}else {
    		$hi=new History(array(),20);
    		if ($user_path=="")  $user_path='/';
    		$hi->add($user_path);
    		$this->session->set('history', $hi->getHistory());
    		}
    		*/
    		$conditions = "parenturl = :parenturl: AND status = 0";
    		$parameters = array(
    				"parenturl" => $user_path
    		);
    		
    		$gCloudfileManage = GCloudfileManage::find(array(
    				$conditions,
    				'bind' => $parameters
    		));
    	}
    	
    	
    	$list['folderlist'] = array();
    	$list['filelist'] = array();
    	foreach ($gCloudfileManage as $userFile) {
    		
    		$temp['name'] = $userFile->name;
    		$temp['path'] = $userFile->parenturl;
    		$temp['type'] = $userFile->type;
    		$temp['mode'] = $userFile->type == 'folder' ? 'drwx rwx rwx' : '-rw- r-- r--';
    		$temp['atime'] = $userFile->lastaccesstime;
    		$temp['ctime'] = date('Y-m-d H:i:s', $userFile->createtime);
    		$temp['mtime'] = date('Y-m-d H:i:s', $userFile->modifytime);
			$temp['is_readable'] = $userFile->isreadable;
    		$temp['is_writeable'] = $userFile->iswriteable;
    		$temp['isParent'] =  $this->isParent($userFile->url);
    		
    		if ($userFile->type == 'folder') {
    			$list['folderlist'][] = $temp;
    		}
    		else {
    			$temp['ext'] = $userFile->ext;
    			$temp['size'] = $userFile->size;
    			$temp['size_friendly'] = $userFile->sizefriendly;
    			$list['filelist'][] = $temp;
    		}
    	}
    	
    	$list['history_status']= array();
		
    	return $this->common->show_json($list);
    }
    
    function mkdirAction() {

    	$request = $this->request;
    	if ($request->isGet() == true) {
    		$path = $request->get('path');
    		$filename = $request->get('filename');
    	}
    	
    	$user = $this->session->get('auth');
		
    	date_default_timezone_set('Asia/Shanghai');	// 上海时区
    	$createtime = time();

    	$localPath = $this->session->get('gDiskPath').'/'.time();
		
		$gLocalfileManage = new GLocalfileManage();
		$gLocalfileManage->userid = $user['userid'];
		$gLocalfileManage->name = $filename;
		$gLocalfileManage->tags = $filename;
		$gLocalfileManage->size = 0;
		$gLocalfileManage->type = 'folder';
		$gLocalfileManage->local = $localPath;
		$gLocalfileManage->url = $localPath;
		$gLocalfileManage->status = 0;
		$gLocalfileManage->modifytime = $createtime;
		$gLocalfileManage->createtime = $createtime;
		
		if ($gLocalfileManage->save() == false) {
			
			foreach ($gLocalfileManage->getMessages() as $message) {
				$this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
			}
		}

		$gCloudfileManage = new GCloudfileManage();
		$gCloudfileManage->parenturl = $this->session->get('this_path');
		$gCloudfileManage->name = $filename;
		$gCloudfileManage->oldurl = $path.'/';
		$gCloudfileManage->url = $path.'/';
		$gCloudfileManage->fileid = $gLocalfileManage->readAttribute('fileid');
		$gCloudfileManage->userid = $user['userid'];
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
		$logs->userid = $user['userid'];
		$logs->description = '新建文件夹'.$filename;
		$logs->gcloudid = $gCloudfileManage->readAttribute('gcloudid');
		$logs->ipaddress = $this->common->get_client_ip();
		$logs->createtime = $createtime;
		
		if ($logs->save() == false) {
			foreach ($logs->getMessages() as $message) {
				$this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
			}
		}
		
	    $this->_pathAllow($localPath);
	    
	    if(mkdir($localPath, 0777)) {
	    	chmod($localPath, 0777);
    		$this->common->show_json('新建成功！');
    	}else{
    		$this->common->show_json('新建失败！',false);
    	}
    }
    
    public function mkfileAction() {
    	 
    	$request = $this->request;
    	if ($request->isGet() == true) {
    		$path = $request->get('path');
    		$filename = $request->get('filename');
    	}
    	// 获取文件后缀名
    	$ext = pathinfo($path, PATHINFO_EXTENSION);
    	$user = $this->session->get('auth');
		
    	date_default_timezone_set('Asia/Shanghai');	// 上海时区
    	$createtime = time();
		
    	$localPath = $this->session->get('gDiskPath').time().'.'.$ext;
    	
		$gLocalfileManage = new GLocalfileManage();
		$gLocalfileManage->userid = $user['userid'];
		$gLocalfileManage->name = $filename;
		$gLocalfileManage->tags = $filename;
		$gLocalfileManage->size = 0;
		$gLocalfileManage->type = 'file';
		$gLocalfileManage->local = $localPath;
		$gLocalfileManage->url = $localPath;
		$gLocalfileManage->status = 0;
		$gLocalfileManage->modifytime = $createtime;
		$gLocalfileManage->createtime = $createtime;
		
		if ($gLocalfileManage->save() == false) {
			foreach ($gLocalfileManage->getMessages() as $message) {
				$this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
			}
		}
		
		$gCloudfileManage = new GCloudfileManage();
		$gCloudfileManage->parenturl = $this->session->get('this_path');
		$gCloudfileManage->name = $filename;
		$gCloudfileManage->oldurl = $path;
		$gCloudfileManage->url = $path;
		$gCloudfileManage->fileid = $gLocalfileManage->readAttribute('fileid');
		$gCloudfileManage->userid = $user['userid'];
		$gCloudfileManage->ext = $ext;
		$gCloudfileManage->type = 'file';
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
		$logs->userid = $user['userid'];
		$logs->description = '新建文件'.$filename;
		$logs->gcloudid = $gCloudfileManage->readAttribute('gcloudid');
		$logs->ipaddress = $this->common->get_client_ip();
		$logs->createtime = $createtime;
		
		if ($logs->save() == false) {
			foreach ($logs->getMessages() as $message) {
				$this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
			}
		}
    	
    	$this->_pathAllow($localPath);
    	if(touch($localPath)){
    		$this->common->show_json('新建成功！');
    	}else{
    		$this->common->show_json('新建失败！',false);
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
    
    // 检测本地文件路径
    public function _checkLocalFilePath($path) {
    	
    	$condition = "url='".$path."'";
    	$gCloudfileManage = GCloudfileManage::findFirst($condition);
		
    	if ($gCloudfileManage) return true;
    	else return false;
    }
    
    public function pathRnameAction() {
    	
    	// Todo: 修改数据库中文件名
		$request = $this->request;
        if ($request->isPost() == true) {
        	$from 		= $request->getPost('from');
        	$rname_to	= $request->getPost('rname_to');
        }
        
        $user = $this->session->get('auth');
        
        $from_name_array = explode('/', $from);
        $name_array = explode('/', $rname_to);
		
        if ($this->file->get_path_ext($from) == '') {
        	$from = $from.'/';
        }
        
        // 修改原文件相关信息
        $gCloudfileManage = GCloudfileManage::findFirst("url='$from'");
        $gcManage = new GCloudfileManage();
        $gcManage = $gCloudfileManage;
        $gcManage->name = end($name_array);        
        $gcManage->url =  $gCloudfileManage->type=='folder' ? $rname_to.'/' : $rname_to;
        $gcManage->modifytime = time();
        if ($gcManage->update() == false) {
        	foreach ($gcManage->getMessages() as $message) {
    			$this->common->show_json('重命名失败！'.$message, false);
        	}
        }
        
        if ($gCloudfileManage->type == 'folder') {
        	// 更改下级文件路径
        	$this->modifySubFolderPath($rname_to.'/', $from, $gCloudfileManage->type);
        }
		
        // 写入操作日志
    	$logs = new Logs();
		$logs->userid = $user['userid'];
		$logs->description = '修改文件名'.end($from_name_array).'为'.end($name_array);
		$logs->gcloudid = $gCloudfileManage->gcloudid;
		$logs->ipaddress = $this->common->get_client_ip();
		$logs->createtime = time();
		if ($logs->save() == false) {
			foreach ($logs->getMessages() as $message) {
    			$this->common->show_json('日志写入失败！'.$message, false);
			}
		}
    	
    	$this->common->show_json('重命名成功！');
    }
    
    public function pathDeleteAction() {
		
    	$request = $this->request;
    	
    	if ($request->isPost() == true) {
    		$list_post = $request->getPost('list');
    	}
    	$list = json_decode($list_post, true);
  
    	foreach ($list as $value) {
    		if ($value['type'] == 'folder') {
    			$condition = "url='".$value['path']."/'";
    		}
    		else {
    			$condition = "url='".$value['path']."'";
    		}
    		 
	    	$gCloudfileManage = GCloudfileManage::findFirst($condition);
	        $gcManage = new GCloudfileManage();
	        $gcManage = $gCloudfileManage;
	        $gcManage->status = 1;
	        $gcManage->modifytime = time();
	        if ($gcManage->update() == false) {
	        	foreach ($gcManage->getMessages() as $message) {
					return $this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
	        	}
	        }
    	}
    	
    	$this->common->show_json('删除成功！');
    }
    
    public function pathCopyAction() {
    	// Todo: 复制数据库中文件
    	$request = $this->request;
    	
    	if ($request->isPost() == true) {
    		$list_post = $request->getPost('list');
    	}
    	$list = json_decode($list_post);
    	
    	// 复制信息存放到session中
    	$this->session->set('path_copy_type', 'copy');
    	$this->session->set('path_copy', $list);
    	$this->session->set('copy_times', 0);
    	
    	// 如果复制成功
    	if ($list) $this->common->show_json('复制成功！');
    	else $this->common->show_json('复制失败！', false);
    }
    
    public function pathCuteAction() {
    	// Todo: 剪切数据库中文件
    	$request = $this->request;
    	
    	if ($request->isPost() == true) {
    		$list_post = $request->getPost('list');
    	}
		
    	$list = json_decode($list_post);
    	
    	$this->session->set('path_copy', $list);
    	$this->session->set('path_copy_type', 'cute');
    	 
    	$success = 1;
    	// 如果复制成功
    	if ($success) $this->common->show_json('【剪切】 ----复制到剪切板成功！');
    	else $this->common->show_json('剪切失败！', false);
    }
    
    public function pathPastAction($path='') {
    	
    	if (!empty($path)) {
    		$parentUrl = urldecode($path);
    	}
    	else {
    		$parentUrl = $this->session->get('gDiskPath');
    	}

    	// 如果是剪切状态，粘贴成功需清空剪切板
    	$list = $this->session->get('path_copy');
    	$copy_type = $this->session->get('path_copy_type');
    	
    	if (empty($copy_type) || $copy_type=='') {
    		return $this->common->show_json('剪切板内容为空！', false);
    	}

    	$copy_times = $this->session->get('copy_times');
		
    	foreach ($list as $value) {
    	
    		$isExist = true; // 验证路径是否存在
			
    		if ($copy_type == 'copy') {
	    		while ($isExist == true) {
	    			$copy_times = $this->session->get('copy_times');
					
	    			
		    		if ($value->type == 'folder') {
		    			$condition = "url='".$value->path."/'";
		    			$url_array = explode('/', $value->path);	// 数组
		    			$filename = end($url_array);	// 文件名
		    			$ext = '';
		    			$new_filename = $copy_times==0 ? end($url_array).'副本' : end($url_array)."副本($copy_times)";
		    			$new_path = $copy_times==0 ? $parentUrl.$filename.'副本/' : $parentUrl.$filename."副本($copy_times)/";
		    		}
		    		else {
		    			$condition = "url='".$value->path."'";
		    			$url_array = explode('/', $value->path);	// 数组
		    			$filename = end($url_array);	// 文件名
		    			$ext = '.'.pathinfo($value->path, PATHINFO_EXTENSION);	// 扩展名
		    			$new_filename = $copy_times==0 ? str_replace($ext, '副本'.$ext, $filename) : str_replace($ext, "副本($copy_times)".$ext, $filename);
		    			$new_copy_path = $copy_times==0 ? $parentUrl.$filename : $parentUrl.$filename;
		    			$new_path = $copy_times==0 ? str_replace($ext, '副本'.$ext, $new_copy_path) : str_replace($ext, "副本($copy_times)".$ext, $new_copy_path);
		    		}
		    		
	 	    		// Todo: 递归查询文件路径是否存在
		    		if ($this->_checkLocalFilePath($new_path)) {
		    			$copy_times = $this->session->set('copy_times', $copy_times+1);
		    		}
		    		else {
		    			$isExist = false;
		    		}
	    		}
    		}
    		else {
    			$is_dir =  $value->type == 'folder' ? '/' : '';
    			$condition = "url='".$value->path.$is_dir."'";
    			$url_array = explode('/', $value->path);	// 数组
    			$filename = end($url_array);	// 文件名
    			$ext = '';
    			$new_filename = $copy_times==0 ? end($url_array) : end($url_array)."($copy_times)";
    			$new_path = $parentUrl."$filename".$is_dir;
    		}
    		
    		// 查询被复制文件信息
    		$gCloudfileManage = GCloudfileManage::findFirst($condition);
    		$createtime = time();
    		// 查询被复制文件信息
    		$gLocalfileManage = GLocalfileManage::findFirst("fileid = '$gCloudfileManage->fileid'");
    		
    		// 新的被复制文件地址
    		$local_array = explode('/', $gLocalfileManage->local);
    		$local_array[count($local_array)-1] = $createtime.$ext;
    		$local_url = implode('/', $local_array);
    		
    		$user = $this->session->get('auth');
    		if ($copy_type == 'copy') {
	    		// Todo: 保存文件物理信息
	    		$glManage = new GLocalfileManage();
	    		$glManage->userid = $user['userid'];
	    		$glManage->name = $createtime.$ext;
	    		$glManage->tags = $new_path;
	    		$glManage->size = $gLocalfileManage->size;
	    		$glManage->type = $value->type;
	    		$glManage->local = $local_url;
	    		$glManage->url = $local_url;
	    		$glManage->status = 0;
	    		$glManage->modifytime = $createtime;
	    		$glManage->createtime = $createtime;
				
	    		if ($glManage->save() == false) {    			 
	    			foreach ($glManage->getMessages() as $message) {
	    				echo 1;
	    				return $this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
	    			}
	    		}
	    		
	    		// 保存副本文件信息
		    	$gcManage = new GCloudfileManage();
				$gcManage->parenturl = $parentUrl;
				$gcManage->name = $new_filename;
				$gcManage->oldurl = $new_path;
				$gcManage->url = $new_path;
				$gcManage->fileid = $glManage->readAttribute('fileid');
				$gcManage->userid = $user['userid'];
				$gcManage->ext = $ext;
				$gcManage->type = $value->type;
				$gcManage->accesstimes = 1;
				$gcManage->isencryption = $gCloudfileManage->isencryption;
				$gcManage->isreadable = $gCloudfileManage->isreadable;
				$gcManage->iswriteable = $gCloudfileManage->iswriteable;
				$gcManage->size = $gCloudfileManage->size;
				$gcManage->sizefriendly = $gCloudfileManage->sizefriendly;
				$gcManage->status = 0;
				$gcManage->lastaccesstime = $createtime;
				$gcManage->modifytime = $createtime;
				$gcManage->createtime = $createtime;
				
				if ($gcManage->save() == false) {
					foreach ($gcManage->getMessages() as $message) {
	    				return $this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
					}
				}
				if ($value->type == 'folder') {
					$parenturl = $parentUrl.$new_filename.'/';
					$this->copyCreateSubFolderPath($parenturl, $gCloudfileManage->url, $value->type);
				}
    		}
    		else {
				// 修改原文件相关信息
				$gCloudfileManage = GCloudfileManage::findFirst($condition);
				
				$oldPathUrl = $gCloudfileManage->url;
				$type = $gCloudfileManage->type;
				
				$gcManage = new GCloudfileManage();
				$gcManage = $gCloudfileManage;
				$gcManage->parenturl = $parentUrl;
				$gcManage->oldurl = $new_path;
				$gcManage->url = $new_path;
				$gcManage->modifytime = time();
				
				if ($gcManage->update() == false) {
					foreach ($gcManage->getMessages() as $message) {
						return $this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
					}
				}
				
				if ($type == 'folder') {
					$this->modifySubFolderPath($new_path, $oldPathUrl, $type);
				}
			}

			$logs = new Logs();
			$logs->userid = $user['userid'];
			$logs->description = '粘贴文件：'.$filename.'为'.$new_filename;
			$logs->gcloudid = $gCloudfileManage->readAttribute('gcloudid');
			$logs->ipaddress = $this->common->get_client_ip();
			$logs->createtime = $createtime;
			
			if ($logs->save() == false) {
				foreach ($logs->getMessages() as $message) {
					return $this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
				}
			}
			

    	}
    	
    	if ($copy_type == 'copy') {
    		$info= '粘贴成功！';
    		$this->session->set('copy_times', $copy_times+1);
    	}
    	else {
    		$path_copy = $this->session->set('path_copy', json_encode(array()));
    		$copy_type = $this->session->set('path_copy_type', '');
    		$info= '粘贴成功,并清空剪切板！';
    	}
    	
    	
    	$this->common->show_json($info);
    }
    
    public function pathInfoAction() {
    	
    	// Todo: 从数据库中获取文件属性
    	$request = $this->request;
    	 
    	if ($request->isPost() == true) {
    		$info_list = $request->getPost('list');
    	}
    	
    	$list = json_decode($info_list);
    	
    	foreach ($list as $value) {		
    	
    		if ($value->type == 'folder') {
    			$condition = "url='$value->path/'";
    		}
    		else {
    			$condition = "url='$value->path'";
    		}

    		$gCloudfileManage = GCloudfileManage::findFirst($condition);
    		if (!$gCloudfileManage) {
    			$gCloudfileManage = GCloudfileManage::findFirst("url='$value->path'");
    			if (!$gCloudfileManage) {
    				$gCloudfileManage = GCloudfileManage::find("parenturl='$value->path'");
    			}
    		}

    		$data['name'] = $gCloudfileManage->name;
		    $data['path'] = $gCloudfileManage->url;
		    $data['ext'] = $gCloudfileManage->ext;
		    $data['type'] = $gCloudfileManage->type;
		    $data['mode'] = '-rwx rwx rwx';
		    $data['atime'] =  date("Y-m-d H:i:s", $gCloudfileManage->lastaccesstime);
		    $data['ctime'] =  date("Y-m-d H:i:s", $gCloudfileManage->createtime);
		    $data['mtime'] =  date("Y-m-d H:i:s", $gCloudfileManage->modifytime);
		    $data['is_readable'] =$gCloudfileManage->isreadable;
		    $data['is_writeable'] = $gCloudfileManage->iswriteable;
		    $data['size'] = @$data['size'] + $gCloudfileManage->size;
		    if ($data['size'] > 1024) {
		    	$data['size_friendly'] = ($data['size']/1024) . ' kB';
		    }
		    else if ($data['size'] > 1024*1024) {
		    	$data['size_friendly'] = ($data['size']/(1024*1024)) .' M';
		    }
		    else if  ($data['size'] > 1024*1024*1024) {
		    	$data['size_friendly'] = ($data['size']/(1024*1024*1024)) .' G';
		    }
		    else {
		    	$data['size_friendly'] = $data['size'] . ' B';
		    }
// 		    $data['size_friendly'] = $gCloudfileManage->sizefriendly;
    	}
    	
    	$this->common->show_json($data);
    }
    
    public function pathCuteDragAction() {
    	
    	$request = $this->request;
    	 
    	if ($request->isPost() == true) {
    		$list_post = $request->getPost('list');
    		$path_post = $request->getPost('path');
    	}
    	
    	$pathArray = json_decode($list_post);
    	$parentUrl = $path_post . '/';

    	foreach ($pathArray as $pathInfo) {
    		$type = $pathInfo->type;	// 文件类型
    		$pathUrl = $pathInfo->path . ($type=='folder' ? '/' : '');
    		
    		$gCloudfileManage = GCloudfileManage::findFirst("url='$pathUrl'");
    		
    		$oldparenturl = $gCloudfileManage->parenturl;
    		$parenturl	= str_replace($gCloudfileManage->parenturl, $parentUrl, $gCloudfileManage->parenturl);
    		$oldurl		= str_replace($gCloudfileManage->parenturl, $parentUrl, $gCloudfileManage->oldurl);
    		$url		= str_replace($gCloudfileManage->parenturl, $parentUrl, $gCloudfileManage->url);
	    	// 修改原文件相关信息
	    	$gcManage = new GCloudfileManage();
	    	$gcManage = $gCloudfileManage;
	    	$gcManage->parenturl = $parenturl;
			$gcManage->oldurl = $oldurl;
	    	$gcManage->url = $url;
	    	$gcManage->modifytime = time();
	    	
	    	if ($gcManage->update() == false) {
	    		foreach ($gcManage->getMessages() as $message) {
	    			return $this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
	    		}
	    	}
	    	
	    	if ($type == 'folder') {
	    		$this->modifySubFolderPath($url, $pathUrl, $type);
	    	}
    	}
    	
    	// Todo: 拖动移动文件
    	$this->common->show_json('移动成功！');
    }
    
    /**
     * 复制并创建下级文件
     * @param unknown $parentUrl 新的上级路径
     * @param unknown $pathUrl	原上级路径
     * @param unknown $type	文件类型
     */
    public function copyCreateSubFolderPath($parentUrl, $pathUrl, $type) {
    
// 		echo '$parentUrl:'.$parentUrl;
//     	echo "<br>";
// 		echo '$pathUrl:'.$pathUrl;
// 		echo "<br>";
// 		echo '$type:'.$type;
// 		echo "<br>";
// 		echo "-------------------------<br>";
    	
    	$user = $this->session->get('auth');
    	// 查询被复制文件信息
    	$gCloudfileManage = GCloudfileManage::find("parenturl='$pathUrl'");
    	
    	if ($gCloudfileManage) {
    		
    		foreach ($gCloudfileManage as $value) {
    			
		    	$parenturl	= str_replace($value->parenturl, $parentUrl, $value->parenturl);
		    	$oldurl		= str_replace($value->parenturl, $parentUrl, $value->oldurl);
		    	$url		= str_replace($value->parenturl, $parentUrl, $value->url);
		    	$oldParentUrl = $value->url;
		    	$type = $value->type;
    	 
    	//     			echo '$parenturl:'.$parenturl;
    	//     			echo "<br>";
    	//     			echo '$value->parenturl:'.$value->parenturl;
    	//     			echo "<br>";
    	//     			echo '$url:'.$url;
    	//     			echo "<br>";
    	//     			echo '$value->url:'.$value->url;
    	//     			echo "<br>";
    	
		    	$createtime = time();
		    	// 查询被复制文件信息
		    	$gLocalfileManage = GLocalfileManage::findFirst("fileid = '$value->fileid'");
		    	 
		    	// 新的被复制文件地址
		    	$ext = '.'.pathinfo($gLocalfileManage->local, PATHINFO_EXTENSION);	// 扩展名
		    			  
		    	$local_array = explode('/', $gLocalfileManage->local);
		    	$local_array[count($local_array)-1] = $createtime.$ext;
		    	$local_url = implode('/', $local_array);
		    	 
		    	// Todo: 保存文件物理信息
		    	$glManage = new GLocalfileManage();
		    	$glManage->userid = $user['userid'];
		    	$glManage->name = $createtime.$ext;
		    	$glManage->tags = $createtime.$ext;
		    	$glManage->size = $gLocalfileManage->size;
		    	$glManage->type = $gLocalfileManage->type;
		    	$glManage->local = $local_url;
		    	$glManage->url = $local_url;
		    	$glManage->status = 0;
		    	$glManage->modifytime = $createtime;
		    	$glManage->createtime = $createtime;
		    	 
		    	if ($glManage->save() == false) {
		    		foreach ($glManage->getMessages() as $message) {
		    			echo 1;
		    			return $this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
		    		}
		    	}
		    	
		    	// 保存副本文件信息
		    	$gcManage = new GCloudfileManage();
		    	$gcManage->parenturl = $parenturl;
		    	$gcManage->name = $value->name;
		    	$gcManage->oldurl = $url;
		    	$gcManage->url = $url;
		    	$gcManage->fileid = $glManage->readAttribute('fileid');
		    	$gcManage->userid = $user['userid'];
		    	$gcManage->ext = $ext;
		    	$gcManage->type = $value->type;
		    	$gcManage->accesstimes = 1;
		    	$gcManage->isencryption = $value->isencryption;
		    	$gcManage->isreadable = $value->isreadable;
		    	$gcManage->iswriteable = $value->iswriteable;
		    	$gcManage->size = $value->size;
		    	$gcManage->sizefriendly = $value->sizefriendly;
		    	$gcManage->status = 0;
		    	$gcManage->lastaccesstime = $createtime;
		    	$gcManage->modifytime = $createtime;
		    	$gcManage->createtime = $createtime;
		    	 
		    	if ($gcManage->save() == false) {
		    		foreach ($gcManage->getMessages() as $message) {
		    			return $this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
		    		}
		    	}
    		 
    			if ($value->type == 'folder') {
    					$this->copyCreateSubFolderPath($url, $oldParentUrl, $type);
    			}
    		}
    	}
    	else {
		    $gCloudfileManage = GCloudfileManage::findFirst("url='$pathUrl'");
		    
		    	$parenturl	= str_replace($gCloudfileManage->parenturl, $parentUrl, $gCloudfileManage->parenturl);
		    	$oldurl		= str_replace($gCloudfileManage->parenturl, $parentUrl, $gCloudfileManage->oldurl);
		    	$url		= str_replace($gCloudfileManage->parenturl, $parentUrl, $gCloudfileManage->url);
		    	$oldParentUrl = $gCloudfileManage->url;
		    	$type = $gCloudfileManage->type;
    	 
    	//     			echo '$parenturl:'.$parenturl;
    	//     			echo "<br>";
    	//     			echo '$value->parenturl:'.$value->parenturl;
    	//     			echo "<br>";
    	//     			echo '$url:'.$url;
    	//     			echo "<br>";
    	//     			echo '$value->url:'.$value->url;
    	//     			echo "<br>";
    	
		    	$createtime = time();
		    	// 查询被复制文件信息
		    	$gLocalfileManage = GLocalfileManage::findFirst("fileid = '$gCloudfileManage->fileid'");
		    	
		    	// 新的被复制文件地址
		    	$ext = '.'.pathinfo($gLocalfileManage->local, PATHINFO_EXTENSION);	// 扩展名
		    			  
		    	$local_array = explode('/', $gLocalfileManage->local);
		    	$local_array[count($local_array)-1] = $createtime.$ext;
		    	$local_url = implode('/', $local_array);
		     
		    // Todo: 保存文件物理信息
		    $glManage = new GLocalfileManage();
		    $glManage->userid = $user['userid'];
		    $glManage->name = $createtime.$ext;
		    $glManage->tags = $createtime.$ext;
		    $glManage->size = $gLocalfileManage->size;
		    $glManage->type = $gLocalfileManage->type;
		    $glManage->local = $local_url;
		    $glManage->url = $local_url;
		    $glManage->status = 0;
		    $glManage->modifytime = $createtime;
		    $glManage->createtime = $createtime;
		     
		    if ($glManage->save() == false) {
		    	foreach ($glManage->getMessages() as $message) {
		    		echo 1;
		    		return $this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
		    	}
		    }
		    
		    // 保存副本文件信息
		    $gcManage = new GCloudfileManage();
		    $gcManage->parenturl = $parentUrl;
		    $gcManage->name = $gCloudfileManage->name;
		    $gcManage->oldurl = $url;
		    $gcManage->url = $url;
		    $gcManage->fileid = $glManage->readAttribute('fileid');
		    $gcManage->userid = $user['userid'];
		    $gcManage->ext = $ext;
		    $gcManage->type = $gCloudfileManage->type;
		    $gcManage->accesstimes = 1;
		    $gcManage->isencryption = $gCloudfileManage->isencryption;
		    $gcManage->isreadable = $gCloudfileManage->isreadable;
		    $gcManage->iswriteable = $gCloudfileManage->iswriteable;
		    $gcManage->size = $gCloudfileManage->size;
		    $gcManage->sizefriendly = $gCloudfileManage->sizefriendly;
		    $gcManage->status = 0;
		    $gcManage->lastaccesstime = $createtime;
		    $gcManage->modifytime = $createtime;
		    $gcManage->createtime = $createtime;
		     
		    if ($gcManage->save() == false) {
		    	foreach ($gcManage->getMessages() as $message) {
		    		return $this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
		    	}
		    }
    	}
    }
    
    /**
     * 修改下级文件路径
     * @param unknown $parentUrl 新的上级路径
     * @param unknown $pathUrl	原上级路径
     * @param unknown $type	文件类型
     */
    public function modifySubFolderPath($parentUrl, $pathUrl, $type) {


//     	echo '$parentUrl:'.$parentUrl;
//     	echo "<br>";
//     	echo '$pathUrl:'.$pathUrl;
//     	echo "<br>";
//     	echo '$type:'.$type;
//     	echo "<br>";
//     	echo "-------------------------<br>";
    	$gCloudfileManage = GCloudfileManage::find("parenturl='$pathUrl'");
    	
    	if ($gCloudfileManage) {
    		foreach ($gCloudfileManage as $value) {
				
    			$parenturl	= str_replace($value->parenturl, $parentUrl, $value->parenturl);
    			$oldurl		= str_replace($value->parenturl, $parentUrl, $value->oldurl);
    			$url		= str_replace($value->parenturl, $parentUrl, $value->url);
    			$oldParentUrl = $value->url;
    			
//     			echo '$parenturl:'.$parenturl;
//     			echo "<br>";
//     			echo '$value->parenturl:'.$value->parenturl;
//     			echo "<br>";
//     			echo '$url:'.$url;
//     			echo "<br>";
//     			echo '$value->url:'.$value->url;
//     			echo "<br>";
    			// 修改原文件相关信息
    			$gcManage = new GCloudfileManage();
    			$gcManage = $value;
    			$gcManage->parenturl = $parenturl;
    			$gcManage->oldurl = $oldurl;
    			$gcManage->url = $url;
    			$gcManage->modifytime = time();
    			
    			if ($gcManage->update() == false) {
    				foreach ($gcManage->getMessages() as $message) {
    					return $this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
    				}
    			}
    			
    			if ($value->type == 'folder') {
    				$this->modifySubFolderPath($url, $oldParentUrl, $value->type);
    			}
    		}
    	}
    	else {
    		$gCloudfileManage = GCloudfileManage::findFirst("url='$pathUrl'");
    		
    		$parenturl	= str_replace($gCloudfileManage->parenturl, $parentUrl, $gCloudfileManage->parenturl);
    		$oldurl 	= str_replace($gCloudfileManage->parenturl, $parentUrl, $gCloudfileManage->oldurl);
    		$url		= str_replace($gCloudfileManage->parenturl, $parentUrl, $gCloudfileManage->url);
    		
	    	// 修改原文件相关信息
	    	$gcManage = new GCloudfileManage();
	    	$gcManage = $gCloudfileManage;
	    	$gcManage->parenturl = $parenturl;
			$gcManage->oldurl = $oldurl;
	    	$gcManage->url = $url;
	    	$gcManage->modifytime = time();
	    	
	    	if ($gcManage->update() == false) {
	    		foreach ($gcManage->getMessages() as $message) {
	    			return $this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
	    		}
	    	}
    	}
    }
    
    public function pathCopyDragAction() {
    	
    	$request = $this->request;
    	 
    	if ($request->isPost() == true) {
    		$list_post = $request->getPost('list');
    	}
    	$path_past = $this->session->get('this_path');

    	// Todo: 创建副本
    	$data = Array('新建文件夹(1)', '新建文件夹(0)(1)');
		
    	$this->common->show_json($data, true);
    }
    
    public function fileDownloadAction() {
    	
    	$request = $this->request;
    	
    	if ($request->isGet() == true) {
    		$this_path = $request->get('this_path');
    		
    		// 下载路径必须正确否则失败
    		$this->file->file_download($this_path);
    	}
    	else {
    		$this->common->show_json('下载失败！');
    	}
    }
    
    // 远程下载
    public function fileProxyAction() {
    	$this_path = $this->request->get('path');
    	$gCloudfileManage = GCloudfileManage::findFirst("url='$this_path'");
    	
    	if ($gCloudfileManage) {
    		$fileid	= $gCloudfileManage->fileid;
    		 
    		$gLocalfileManage = GLocalfileManage::findFirst("fileid='$fileid'");
    	
    		$this_path = $gLocalfileManage->local;
    	}

//     	if (!$GLOBALS['is_root']) $this->common->show_json($this->L['no_permission'],false);
    	$this->file->file_proxy_out($this_path);
    }
    
    /**
     * 上传,html5拖拽  flash 多文件
     */
    public function fileUploadAction(){
    	
    	$save_path = $this->request->get('path');
    	$fullPath = $this->request->get('fullPath');
    	if (empty($fullPath)) {
    		$full_path = $this->request->getPost('fullPath');
    	}
    	if ($save_path == '') $this->common->show_json('上传路径不存在', false);

    	if (strlen($fullPath) > 1) {//folder drag upload
    		$full_path = $this->util->_DIR_CLEAR(rawurldecode($fullPath));
    		$full_path = get_path_father($full_path);
    		$full_path = $this->file->iconv_system($full_path);
    		if (mk_dir($save_path.$full_path)) {
    			$save_path = $save_path.$full_path;
    		}
    	}
    	
    	$this->file->upload('file', $save_path);
    }
    
    // 图片缩略图生成
    public function imageAction(){
    	$auth = $this->session->get('auth');
    	
    	$pic_thumb = BASIC_PATH.'data/'.$auth['userid'].'/thumb/';	// 缩略图生成存放地址    
    		 
    	$request = $this->request;
    	    	
    	if ($request->isGet() == true) {
    		$this_path = urldecode($request->get('path'));
    		
    		$gCloudfileManage = GCloudfileManage::findFirst("url='$this_path'");
    		
    		if ($gCloudfileManage) {
    			$fileid	= $gCloudfileManage->fileid;
    			
    			$gLocalfileManage = GLocalfileManage::findFirst("fileid='$fileid'");
    			 
    			$this_path = $gLocalfileManage->local;
    		}
    	}
    	
    	if (filesize($this_path) <= 1024*10) {//小于10k 不再生成缩略图
    		$this->file->file_proxy_out($this_path);
    	}
    	$image= $this_path;
    	
    	$image_md5  = md5($image);
    	
    	$image_thum = $pic_thumb.$image_md5.'.png';
    	
    	if (!is_dir($pic_thumb)){
    		mkdir($pic_thumb,"0777");
    	}
    	
    	if (!file_exists($image_thum)){ // 如果拼装成的url不存在则没有生成过
    		if ($this->session->get('this_path')==$pic_thumb){//当前目录则不生成缩略图
    			$image_thum = $this_path;
    		}else {
    			

				$this->imagethumb->SetVar($image,'file');
    			//$this->imagethumb->Prorate($image_thum,72,64); //生成等比例缩略图
    			$this->imagethumb->BackFill($image_thum,72,64,true); //等比例缩略图，空白处填填充透明色
    		}
    	}
    	if (!file_exists($image_thum) || filesize($image_thum)<100){//缩略图生成失败则用默认图标
    		$image_thum=STATIC_PATH.'images/image.png';
    	}
    	//输出
    	$this->file->file_proxy_out($image_thum);
    	
    }
    
    // 搜索方法
    public function searchAction(){
    	
    	$request = $this->request;
    	 
    	if ($request->isPost() == true) {
    		$search = $request->getPost('search');
    		$path	= $request->getPost('path');
    	}
		
    	if ($this->common->inject_check($search)) {
    		return $this->common->show_json('输入名称错误！', false);
    	}
    	
    	$condition = "name LIKE '%$search%'";
    	
    	$gCloudfileManage = GCloudfileManage::find($condition);
    	
    	$list['folderlist'] = array();
    	$list['filelist']	= array();
    	foreach ($gCloudfileManage as $key=>$value) {
    		
    		if ($value->type == 'folder') {
    			$list['folderlist'][$key]['name'] = $value->name; 
    			$list['folderlist'][$key]['path'] = $value->parenturl;
    		}
    		else {
    			$list['filelist'][$key]['name'] = $value->name;
    			$list['filelist'][$key]['path'] = $value->parenturl;
    		}
    		
    	}
		
    	$this->common->show_json($list);
    }
    
    public function shareAction($action='') {
		
    	$request = $this->request;
    	
    	if ($request->isPost() == true) {
    		$slist = $request->getPost('list');
    		$action = $request->getPost('action');
    		if (!empty($slist)) {
    			$this->session->set('share_list', $slist);
    		}
    	}
		
    	if ($this->session->has('share_list')) {
    		$share_list = $this->session->get('share_list');
    	}
    	if ($share_list) {
    		$share_arr = json_decode($share_list);
    		$share_link = $share_arr[0]->path;
    		if ($action == 'linkShare') {
    			$gCloudfileManage = GCloudfileManage::findFirst("url='$share_link'");
    			$data = array('name'=>$gCloudfileManage->name, 'path'=>'http://'.$_SERVER['HTTP_HOST'].'/index/filedownload?this_path='.$gCloudfileManage->url);
    			$this->common->show_json($data);
    		}
    		else if ($action == 'circleShare') {
				
    		}
    		else {
    			$gCloudfileManage = GCloudfileManage::findFirst("url='$share_link'");
				$username = $request->getPost('username');
				if ($username) {
					$user = Users::findFirst("username='$username'");
					
					$share = new Share();
					$share->cloudid = $gCloudfileManage->gcloudid;
					$share->userid = $gCloudfileManage->userid;
					$share->useredid = $user->userid;
					$share->filename = $gCloudfileManage->name;
					$share->fileurl = $gCloudfileManage->url;
					$share->isencryption = 0;
					$share->status = 0;
					$share->createtime = time();
					
					if ($share->save() == false) {
						foreach ($user->getMessages() as $message) {
							$this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
						}
					
						$this->common->show_json('分享失败', false);
					}
					else {
						$this->common->show_json('分享成功');
					}
				}
				$this->common->show_json('获取成功');
    		}
    	}
    	else {
    		$this->common->show_json('错误', false);
    	}
    }
    
    // 新建圈子
    public function newcircleAction() {
    	
    	
    	$this->common->show_json('错误');
    	 
//     	exit;
//     	return 0;
    }
}
