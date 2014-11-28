<?php

use Phalcon\Tag as Tag;

class CircleController extends ControllerBase
{
	public $userid = '';
	public $username = '';
	public $roleids = '';
	
	public function initialize()
	{
		$config = new Phalcon\Config\Adapter\Ini(__DIR__.'/../config/config.ini');
		$this->session->set('object_name', $config->object->object_name);

		parent::initialize();

                /*Loading public part*/
                $authInfo = $this->session->get('auth');
                if (!$authInfo) {
                        return $this->forward('session/index');
                }

                $this -> userid = $authInfo['userid'];
                $this -> username = $authInfo['username'];
                $this -> roleids = $authInfo['roleids'];

		$logList = Logs::find (' 1=1 order by createtime desc limit 10');
		$this->view->setVar('logList', $logList);

		$sql = "SELECT Circle.name name,Circle.circleid circleid FROM Circle RIGHT JOIN CircleMember ON Circle.circleid=CircleMember.circle_id WHERE CircleMember.member_id='$this->userid'";
                $circleList = $this->modelsManager->executeQuery ( $sql );

		$this->view->setVar('roleids',$authInfo['roleids']);
                $this->view->setVar('circleList',$circleList);
		
	}

	public function indexAction()
	{
		$this->view->setTemplateAfter('topbar');	// 框架通用菜单

		Tag::setTitle($this->session->get('object_name').' | 圈子');
		
		//         if (!$this->request->isPost()) {
		//             $this->flash->notice('This is a sample application of the Phalcon PHP Framework.
		//                 Please don\'t provide us any personal information. Thanks');
		//         }
		
		//zz查询最新的一条作业
		$user = $this->session->get('auth');
		 $sqls = "SELECT Work.title name,Work.workid workid,Work.starttime starttime,Work.endtime endtime,Work.created created ,WorkCommit.ccloudid iscommit,WorkCommit.commitid commitid FROM WorkCommit LEFT JOIN Work ON WorkCommit.workid=Work.workid WHERE WorkCommit.userid=".$user['userid']." order by WorkCommit.commitid limit 1";
		$mywork_data =  $this->modelsManager->executeQuery ( $sqls );
		//print_r($mywork_data);die;
		foreach($mywork_data as $v){
			$worklist=$v;
		}
		 $this->view->setVar('worklist',$worklist);
		
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

		$conditions = "parenturl = :parenturl:";

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
				$conditions .= "ext = '$value->name' ";
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

			$gCloudfileManage = CCloudfileManage::find(array(
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
				$size = $userFile->size;
				$temp['size'] = $size;
				$sizeFriendly = $userFile->sizefriendly;
				if ($size) {
					if ($size > 1024 * 1024) {
						$sizeFriendly = number_format( $size / 1024 /1024, 2) . ' M'; 
					} else if ($size > 1024) {
						$sizeFriendly = number_format ($size / 1024, 2) . ' KB';
					} else 
						$sizeFriendly = $size . ' B';
				}
				$temp['size_friendly'] = $sizeFriendly;
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

		//$localPath = $this->session->get('cDiskPath').'/'.time();
		$tmp = explode('/', $path);
		array_shift($tmp);
		array_pop($tmp);
		$localPath = '/' . implode('/', $tmp) . '/' . $createtime;

		$cLocalfileManage = new GLocalfileManage();
		$cLocalfileManage->userid = $user['userid'];
		$cLocalfileManage->name = $filename;
		$cLocalfileManage->tags = $filename;
		$cLocalfileManage->size = 0;
		$cLocalfileManage->type = 'folder';
		$cLocalfileManage->local = $localPath;
		$cLocalfileManage->url = $localPath;
		$cLocalfileManage->status = 0;
		$cLocalfileManage->modifytime = $createtime;
		$cLocalfileManage->createtime = $createtime;

		if ($cLocalfileManage->save() == false) {

			foreach ($cLocalfileManage->getMessages() as $message) {
				$this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
			}
		}

		$cCloudfileManage = new CCloudfileManage();
		$cCloudfileManage->parenturl = $this->session->get('this_path');
		$cCloudfileManage->name = $filename;
		$cCloudfileManage->oldurl = $path.'/';
		$cCloudfileManage->url = $path.'/';
		$cCloudfileManage->fileid = $cLocalfileManage->readAttribute('fileid');
		$cCloudfileManage->userid = $user['userid'];
		$cCloudfileManage->ext = '';
		$cCloudfileManage->type = 'folder';
		$cCloudfileManage->accesstimes = 1;
		$cCloudfileManage->isencryption = 0;
		$cCloudfileManage->isreadable = 1;
		$cCloudfileManage->iswriteable = 1;
		$cCloudfileManage->size = 0;
		$cCloudfileManage->sizefriendly = '0 B';
		$cCloudfileManage->status = 0;
		$cCloudfileManage->lastaccesstime = $createtime;
		$cCloudfileManage->modifytime = $createtime;
		$cCloudfileManage->createtime = $createtime;

		if ($cCloudfileManage->save() == false) {
			foreach ($cCloudfileManage->getMessages() as $message) {
				$this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
			}
		}

		$logs = new Logs();
		$logs->userid = $user['userid'];
		$logs->description = '新建文件夹'.$filename;
		$logs->gcloudid = $cCloudfileManage->readAttribute('gcloudid');
		$logs->ipaddress = $this->common->get_client_ip();
		$logs->createtime = $createtime;

		if ($logs->save() == false) {
			foreach ($logs->getMessages() as $message) {
				$this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
			}
		}

		$this->_pathAllow($localPath);

		$r = mkdirs ($localPath);
		if($r) {
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

		$tmp = explode('/', $path);
		array_shift($tmp);
		array_pop($tmp);
		$localPath = '/' . implode('/', $tmp) . '/' . $createtime . '.' . $ext;

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

		$cCloudfileManage = new CCloudfileManage();
		$cCloudfileManage->parenturl = $this->session->get('this_path');
		$cCloudfileManage->name = $filename;
		$cCloudfileManage->oldurl = $path;
		$cCloudfileManage->url = $path;
		$cCloudfileManage->fileid = $gLocalfileManage->readAttribute('fileid');
		$cCloudfileManage->userid = $user['userid'];
		$cCloudfileManage->ext = $ext;
		$cCloudfileManage->type = 'file';
		$cCloudfileManage->accesstimes = 1;
		$cCloudfileManage->isencryption = 0;
		$cCloudfileManage->isreadable = 1;
		$cCloudfileManage->iswriteable = 1;
		$cCloudfileManage->size = 0;
		$cCloudfileManage->sizefriendly = '0 B';
		$cCloudfileManage->status = 0;
		$cCloudfileManage->lastaccesstime = $createtime;
		$cCloudfileManage->modifytime = $createtime;
		$cCloudfileManage->createtime = $createtime;

		if ($cCloudfileManage->save() == false) {
			foreach ($cCloudfileManage->getMessages() as $message) {
				$this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
			}
		}

		$logs = new Logs();
		$logs->userid = $user['userid'];
		$logs->description = '新建文件' . $filename;
		$logs->gcloudid = $cCloudfileManage->readAttribute('ccloudid');
		$logs->ipaddress = $this->common->get_client_ip();
		$logs->createtime = $createtime;

		if ($logs->save() == false) {
			foreach ($logs->getMessages() as $message) {
				$this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
			}
		}

		$this->_pathAllow($localPath);

		mkdirs ('/' . implode('/', $tmp) . '/'); //创建圈子目录
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

	/**
	 * 检测本地文件路径
	 * @param unknown_type $path
	 * @author Wanggh
	 * 2014/11/14
	 */
	public function _checkLocalFilePath($path) {

		$condition = "url='".$path."' and status=0";
		$cCloudfileManage = CCloudfileManage::findFirst($condition);

		if ($cCloudfileManage) return true;
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
		$cCloudfileManage = CCloudfileManage::findFirst("url='$from'");
		$cManage = new CCloudfileManage();
		$cManage = $cCloudfileManage;
		$cManage->name = end($name_array);
		$cManage->url =  $cCloudfileManage->type=='folder' ? $rname_to.'/' : $rname_to;
		$cManage->modifytime = time();
		if ($cManage->update() == false) {
			foreach ($cManage->getMessages() as $message) {
				$this->common->show_json('重命名失败！'.$message, false);
			}
		}


		if ($cCloudfileManage->type == 'folder') {
			// 更改下级文件路径
			$this->modifySubFolderPath($rname_to.'/', $from, $cCloudfileManage->type);
		}

		// 写入操作日志
		$logs = new Logs();
		$logs->userid = $user['userid'];
		$logs->description = '修改文件名'.end($from_name_array).'为'.end($name_array);
		$logs->gcloudid = $cCloudfileManage->ccloudid;
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
			$cCloudfileManage = CCloudfileManage::findFirst($condition);
			if ($cCloudfileManage->delete() == false) {
				foreach($userrole->getMessages() as $message ){
					$this->common->show_json('Error : '.$message,false);
				}
			}

/*			$cCloudfileManage = CCloudfileManage::findFirst($condition);
			$cManage = new CCloudfileManage();
			$cManage = $cCloudfileManage;
//			$cManage->url = time();
			$cManage->status = 1;
			$cManage->modifytime = time();
			if ($cManage->update() == false) {
				foreach ($cManage->getMessages() as $message) {
					return $this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
				}
			}*/
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
		if ($list) 
			$this->common->show_json('复制成功！');
		else 
			$this->common->show_json('复制失败！', false);
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

	/**
	 * 文件粘贴
	 * @param unknown_type $path
	 * @author Wanggh
	 * 2014/11/13
	 */
	public function pathPastAction( $path = '') {
//		if (!empty($path)) {
//			$parentUrl = urldecode($path);
//		}
//		else {
//			$parentUrl = $this->session->get('cDiskPath');
//		}

		$parentUrl = isset( $_GET ['c_path']) ? $_GET ['c_path'] : $this->session->get('cDiskPath');
		$parentUrl = $parentUrl ? urldecode( $parentUrl ) : '';
		
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
						$condition = "url='" . $value->path . "/'";
						$url_array = explode('/', $value->path);	// 数组
						$filename = end($url_array);	// 文件名
						$ext = '';
						$new_filename = $copy_times==0 ? end($url_array).'副本' : end($url_array)."副本($copy_times)";
						$new_path = $copy_times==0 ? $parentUrl.$filename.'副本/' : $parentUrl.$filename."副本($copy_times)/";
					} else {
						$condition = "url='" . $value->path . "'";
						$url_array = explode('/', $value->path);	// 数组
						$filename = end($url_array);	// 文件名
						$ext = '.'.pathinfo($value->path, PATHINFO_EXTENSION);	// 扩展名
						$new_filename = $copy_times == 0 ? str_replace($ext, '副本'.$ext, $filename) : str_replace($ext, "副本($copy_times)".$ext, $filename);
						$new_copy_path = $copy_times == 0 ? $parentUrl . $filename : $parentUrl .  $filename;
						$new_path = $copy_times==0 ? str_replace($ext, '副本'.$ext, $new_copy_path) : str_replace($ext, "副本($copy_times)".$ext, $new_copy_path);
					}

					// Todo: 递归查询文件路径是否存在
					if ($this->_checkLocalFilePath($new_path))
						$copy_times = $this->session->set('copy_times', $copy_times + 1);
					else
						$isExist = false;
				}
			} else {
				$is_dir =  $value->type == 'folder' ? '/' : '';
				$condition = "url='".$value->path.$is_dir."'";
				$url_array = explode('/', $value->path);	// 数组
				$filename = end($url_array);	// 文件名
				$ext = '';
				$new_filename = $copy_times==0 ? end($url_array) : end($url_array)."($copy_times)";
				$new_path = $parentUrl."$filename".$is_dir;
			}

			// 查询被复制文件信息
			$cCloudfileManage = CCloudfileManage::findFirst($condition);
			$createtime = time();
			// 查询被复制文件信息
			$gLocalfileManage = GLocalfileManage::findFirst("fileid = '" . $cCloudfileManage->fileid . "'");

			// 新的被复制文件地址
			$local_array = explode('/', $gLocalfileManage->local);
			$local_array [count($local_array)-1] = $createtime.$ext;
			$local_url = implode('/', $local_array);

			$user = $this->session->get('auth');
			if ($copy_type == 'copy') {
				// Todo: 保存文件物理信息
				$glManage = new GLocalfileManage();
				$glManage->userid = $user['userid'];
				$glManage->name = $new_filename;
				$glManage->tags = $new_filename;
				$glManage->size = $gLocalfileManage->size;
				$glManage->type = $value->type;
				$glManage->local = $gLocalfileManage->local;
				$glManage->url = $gLocalfileManage->local;
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
				$cManage = new CCloudfileManage();
				$cManage->parenturl = $parentUrl;
				$cManage->name = $new_filename;
				$cManage->oldurl = $new_path;
				$cManage->url = $new_path;
				$cManage->fileid = $glManage->readAttribute('fileid');
				$cManage->userid = $user['userid'];
				$cManage->ext = str_replace('.','',$ext);
				$cManage->type = $value->type;
				$cManage->accesstimes = 1;
				$cManage->isencryption = $cCloudfileManage->isencryption;
				$cManage->isreadable = $cCloudfileManage->isreadable;
				$cManage->iswriteable = $cCloudfileManage->iswriteable;
				$cManage->size = $cCloudfileManage->size;
				$cManage->sizefriendly = $cCloudfileManage->sizefriendly;
				$cManage->status = 0;
				$cManage->lastaccesstime = $createtime;
				$cManage->modifytime = $createtime;
				$cManage->createtime = $createtime;

				if ($cManage->save() == false) {
					foreach ($cManage->getMessages() as $message) {
						return $this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
					}
				}
				if ($value->type == 'folder') {
					$parenturl = $parentUrl . $new_filename . '/';
					$this->copyCreateSubFolderPath($parenturl, $cCloudfileManage->url, $value->type);
				}
			} else {
				// 修改原文件相关信息
				$cCloudfileManage = CCloudfileManage::findFirst($condition);

				$oldPathUrl = $cCloudfileManage->url;
				$type = $cCloudfileManage->type;

				$cManage = new CCloudfileManage();
				$cManage = $cCloudfileManage;
				$cManage->parenturl = $parentUrl;
				$cManage->oldurl = $new_path;
				$cManage->url = $new_path;
				$cManage->modifytime = time();

				if ($cManage->update() == false) {
					foreach ($cManage->getMessages() as $message) {
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
			$logs->gcloudid = $cCloudfileManage->readAttribute('ccloudid');
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

			$cCloudfileManage = CCloudfileManage::findFirst($condition);
			if (!$cCloudfileManage) {
				$cCloudfileManage = CCloudfileManage::findFirst("url='$value->path'");
				if (!$cCloudfileManage) {
					$cCloudfileManage = CCloudfileManage::find("parenturl='$value->path'");
				}
			}

			$data['name'] = $cCloudfileManage->name;
			$data['path'] = $cCloudfileManage->url;
			$data['ext'] = $cCloudfileManage->ext;
			$data['type'] = $cCloudfileManage->type;
			$data['mode'] = '-rwx rwx rwx';
			$data['atime'] =  date("Y-m-d H:i:s", $cCloudfileManage->lastaccesstime);
			$data['ctime'] =  date("Y-m-d H:i:s", $cCloudfileManage->createtime);
			$data['mtime'] =  date("Y-m-d H:i:s", $cCloudfileManage->modifytime);
			$data['is_readable'] =$cCloudfileManage->isreadable;
			$data['is_writeable'] = $cCloudfileManage->iswriteable;
			$data['size'] = @$data['size'] + $cCloudfileManage->size;
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
			$this->file->c_file_download($this_path);
		} else
			$this->common->show_json('下载失败！');
	}

	/**
	 * 上传,html5拖拽  flash 多文件
	 */
	public function fileUploadAction(){
		ini_set('memory_limit', '100M');
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

		$this->file->c_upload('file', $save_path);
	}

	// 图片缩略图生成
	public function imageAction(){
		$pic_thumb = BASIC_PATH.'data/thumb/';	// 缩略图生成存放地址
		$request = $this->request;

		if ($request->isGet() == true) {
			$this_path = urldecode($request->get('path'));

			$cCloudfileManage = CCloudfileManage::findFirst("url='$this_path'");

			if ($cCloudfileManage) {
				$gLocalfileManage = GLocalfileManage::findFirst("fileid='" . $cCloudfileManage->fileid . "'");
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
				$this->imagethumb->BackFill($image_thum,72,64,true);
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
		$userInfo = $this->session->get('auth');
		//上传Logo
		if (isset($_FILES ['Filedata'])) {
			$file = $_FILES ['Filedata'];
			$fileName = $file ['name'];
			$fileError = $file ['error'];
			$fileSize = $file ['size'];
			$path_info = pathinfo($file['name']);
			$fileExtension = $path_info["extension"];
			$savePath = dirname(__FILE__) . '/../../public/circlestatic/img/circle/tmp/';
			mkdirs($savePath);
			$uploadName = time() . '_' . rand (0, 9) . rand (0, 9) . rand (0, 9) . rand (0, 9) . '.' . $fileExtension;
			@move_uploaded_file( $file ['tmp_name'], $savePath . $uploadName);
			$return = array();
			$return ['img'] = '/circlestatic/img/circle/tmp/' . $uploadName;
			$return ['imgName'] = $uploadName;
			echo json_encode($return);
			die ();
		}
		if (isset($_POST) && $_POST) {
			$circle = new Circle ();
			$circle->name = $_POST ['qz_name'];
			$circle->userid = $userInfo ['userid'];
			$circle->groupid = 0;
			$circle->status = 0;
			$circle->logo = $_POST ['qz_logo'];
			$circle->istopic = $_POST ['topic_flag'];
			$circle->iscomment = $_POST ['comment_flag'];
			$circle->desc = isset( $_POST ['qz_desc'] ) ? $_POST ['qz_desc'] : '';
			$circle->created = time();
			$circle->zone_id = 0;
			$circle->company_id = $_POST ['qz_company_id'];
			$result = $circle->save();
			if($result) {
				$circleId = $circle->readAttribute('circleid');

				$dirArr = array('圈主分享', '通知公告', '作业上传', '通知文件');
				$createtime = time();
				$localPath = DATA_BASIC_PATH . '/c_' . $circleId . '/private/';
				foreach ($dirArr as $value) {
					$cLocalfileManage = new GLocalfileManage();
					$cLocalfileManage->userid = $userInfo['userid'];
					$cLocalfileManage->name = $value;
					$cLocalfileManage->tags = $value;
					$cLocalfileManage->size = 0;
					$cLocalfileManage->type = 'folder';
					$cLocalfileManage->local = $localPath;
					$cLocalfileManage->url = $localPath;
					$cLocalfileManage->status = 0;
					$cLocalfileManage->modifytime = $createtime;
					$cLocalfileManage->createtime = $createtime;
					$cLocalfileManage->save();

					$cCloudfileManage = new CCloudfileManage();
					$cCloudfileManage->parenturl = DATA_BASIC_PATH . '/c_' . $circleId . '/private/';
					$cCloudfileManage->name = $value;
					$cCloudfileManage->oldurl = $localPath . $value . '/';
					$cCloudfileManage->url = $localPath . $value . '/';
					$cCloudfileManage->fileid = $cLocalfileManage->readAttribute('fileid');
					$cCloudfileManage->userid = $userInfo ['userid'];
					$cCloudfileManage->ext = '';
					$cCloudfileManage->type = 'folder';
					$cCloudfileManage->accesstimes = 1;
					$cCloudfileManage->isencryption = 0;
					$cCloudfileManage->isreadable = 1;
					$cCloudfileManage->iswriteable = 1;
					$cCloudfileManage->size = 0;
					$cCloudfileManage->sizefriendly = '0 B';
					$cCloudfileManage->status = 0;
					$cCloudfileManage->lastaccesstime = $createtime;
					$cCloudfileManage->modifytime = $createtime;
					$cCloudfileManage->createtime = $createtime;

					$cCloudfileManage->save();
				}

				if ($circleId) {
					$dir = dirname(__FILE__) . '/../../public/circlestatic/img/circle/' . $circleId . '/';
					mkdirs($dir);
					@rename( dirname(__FILE__) . '/../../public/circlestatic/img/circle/tmp/' . $_POST ['qz_logo'], $dir . $_POST ['qz_logo']);
					$relation = new CircleMember();
					$relation->circle_id = $circleId;
					$relation->member_id = $userInfo ['userid'];
					$relation->type = 2;
					$relation->status = 0;
					$relation->time = time();
					$relation->save();
					
					$categoryId = isset($_POST ['circle_category_id']) ? $_POST ['circle_category_id'] : 0;
					if ($categoryId) {
						$circle_category_relation = new CCategory();
						$circle_category_relation->categoryId = $categoryId;
						$circle_category_relation->circleId = $circleId;
						$circle_category_relation->save();
					}
					
					$admin_id_list = isset($_POST ['qz_admin_id']) ? $_POST ['qz_admin_id'] : '';
					if ($admin_id_list) {
						$admin_id_arr = explode(',', $admin_id_list);
						foreach ($admin_id_arr as $v) {
							$relation = new CircleMember();
							$relation->circle_id = $circleId;
							$relation->member_id = $v;
							$relation->type = 1;
							$relation->status = 0;
							$relation->time = time();
							$relation->save();
						}
					}

					$member_id_list = isset($_POST ['qz_member_id']) ? $_POST ['qz_member_id'] : '';
					if ($member_id_list) {
						$member_id_arr = explode(',', $member_id_list);
						foreach ($member_id_arr as $v) {
							$relation = new CircleMember();
							$relation->circle_id = $circleId;
							$relation->member_id = $v;
							$relation->type = 0;
							$relation->status = 0;
							$relation->time = time();
							$relation->save();
						}
					}
				}
			}
			echo 1;
			die;
		}
		
		$cateGory = Category::find ();
		$goryList = array();
		if ($cateGory) {
			foreach ($cateGory as $value) {
    			if (isset($value->name) && $value->name)
    				$goryList [$value->Id] = $value->name;
    		}
		}
		
		$this->view->setVar('goryList', $goryList);
		$this->view->setVar('userId', $userInfo ['userid']);
		$this->view->setVar('userName', $userInfo ['username']);
    }
    
    /**
     * 获取圈子所以成员
     */
    public function getmemberlistAction () {
    	$userInfo = $this->session->get('auth');
    	$id = $_GET ['id'];
    	$where = 'userid != ' . $userInfo ['userid'];
    	if ($id)
    	 	$where .= ' and userid not in (' . $id . ')';
    	$this->view->setVar('user', Users::find($where));
    }
    
 	public function getAllMemberListAction () {
    	$return = Users::find();
    	$data = array();
    	if ($return) {
    		foreach ($return as $value) {
    			if (isset($value->name) && $value->name)
    				$data [] = $value->name;
    		}
    	}
    	$this->common->show_json( $data);
    }
    public function addexpertAction () {
    	$name = $this->request->get ('name');
    	if ($name) {
    		$member = Users::findfirst (' username="' . $name . '"');
    		$memberId = $member->userid;
    		$relation = new CircleMember();
			$relation->circle_id = $this->request->get('circleId');
			$relation->member_id = $memberId;
			$relation->type = 3;
			$relation->status = 0;
			$relation->time = time();
			$relation->save();
			echo 1;
			die;
    	}
    }
    
    public function getquanzhuAction () {
    	$userInfo = $this->session->get('auth');
    	$id = $_GET ['id'];
		//$where = 'userid != ' . $userInfo ['userid'];
    	$where = '';
    	//if ($id)
    		//$where .= 'userid not in (' . $id . ')';
    	$this->view->setVar('user', Users::find($where));
    }
    
    /**
     * 获取‘我的圈子’列表
     * @author Wanggh
     * 
     */
    public function getlistAction () {
    	$circleId = $this->request->get('circle_id');
    	$pageSize = 8;
    	$user = $this->session->get ('auth');
    	$userId = $user ['userid'];
    	$pageId = $this->request->get('page');
    	$pageId = isset( $pageId ) ? $pageId : 1;
    	$where = '';
    	if ($circleId) {
//    		$where = 'circleid=' . $circleId;
    	} else {
	    	$search = $this->request->get( 'search' );
    		$search = $search ? $search : '';
    		$where = ' name like "%' . $search . '%" and userid=' . $userId . ' and zone_id=0 order by circleid desc';
	    	$list = Circle::find ( $where );
	    	if (count($list)) {
	    		$paginator = new Phalcon\Paginator\Adapter\Model(array(
						"data" => $list,
						"limit" => $pageSize,           
						"page" => $pageId   
						));
			$page = $paginator->getPaginate();
			foreach ($page->items as $key=>$value) {
				$memberIds = '';
				$userDetail = Users::findFirst('userid=' . $value->userid);
				
				//成员个数
				$circleInfo = CircleMember::find('circle_id=' . $value->circleid);
				$page->items [$key]->total_count = count($circleInfo);
				
				//File Count
				foreach ($circleInfo as $v) {
					$memberIds .= $v->member_id . ',';
				}
				$memberIds = $memberIds ? substr($memberIds, 0, -1) : $memberIds;
				if ($memberIds) {
					$file = CCloudfileManage::find ( ' userid IN (' . $memberIds . ') and status=0 and type="file" ' );
				}
				$page->items [$key]->fileCount = $file ? count( $file ) : 0;
				//Topic Count
				$topic = Topic::find (' circleId=' . $value->circleid . ' and status=0');
				$page->items [$key]->topicCount = $topic ? count ($topic) : 0;
				
				//Work count
				$work = Work::find ( ' circleid=' . $value->circleid );
				$page->items [$key]->workCount = $work ? count ($work) : 0;
				
				$page->items [$key]->userName = $userDetail->username;
				$page->items [$key]->logoUrl = $value->logo ? '/circlestatic/img/circle/' . $value->circleid . '/' . $value->logo : '/circlestatic/images/7c.jpg';
			}
		}
		if(isset($page)){
			$this->common->show_json($page);
		}
		$this->common->show_json('no data',false);
		return $this->common->show_json( isset($page) ? $page : false);
	}
	}

	public function getcompanylistAction (){
		$this->view->setVar('companylist', Company::find());
	}

	public function infoAction ( $Id ) {
		$Id = $Id ? $Id : 0;
		if ($Id) {
			$this->session->set('cDiskPath', DATA_BASIC_PATH . '/c_' . $Id . '/private/');
			$info = Circle::findFirst('circleid=' . $Id);
			Tag::setTitle($this->session->get('object_name').' | ' . $info->name);
			$this->view->setVar('circleId', $Id);
			$iscirclemanage = $info->userid == $this->userid ? true : false;
			$this->view->setVar('iscirclemanager',$iscirclemanage);
		}
		$this->view->setTemplateAfter('topbar');
	}
	
	/**
	 * 远程下载
	 * @author Wanggh
	 * 2014/11/13
	 */
    public function fileProxyAction() {
    	$this_path = $this->request->get('path');
    	$cCloudfileManage = CCloudfileManage::findFirst("url='$this_path'");
    	
    	if ($cCloudfileManage) {
    		$gLocalfileManage = GLocalfileManage::findFirst("fileid='" . $cCloudfileManage->fileid . "'");
    		$this_path = $gLocalfileManage->local;
    	}

    	$this->file->file_proxy_out($this_path);
    }


}

if (! function_exists ('mkdirs')) {
	/**
	 * 递归创建目录
	 * @param $dir
	 */
	function mkdirs($dir) {
		if(!is_dir($dir)){
			if( ! mkdirs(dirname($dir))){
				return false; 
			}
			if( ! mkdir($dir,0777))	{
				return false;		
			}
		}
		return true;
	}
}
