<?php 

use Phalcon\Tag as Tag;
use Phalcon\Paginator\Adapter\Model as Paginator;

class NoticeController extends ControllerBase
{

    public function initialize()
    {
    	$config = new Phalcon\Config\Adapter\Ini(__DIR__.'/../config/config.ini');
    	$this->session->set('object_name', $config->object->object_name);
		    	    	
        parent::initialize();
    }
    /**
     * 初始化通知，把属于该圈子，该发布人的通知显示出来
     */

    public function indexAction()
    {
    
       $page =$this->request->get('page');
       if($page==""){
       	
       	$page=1;
       }
       $user = $this->session->get('auth');
    	if (!$user) {
    		return $this->forward('session/index');
    	}
    	
    	$id = $this->request->get('id');
		$this->view->setVar('circle_id',$id);
    	// if($id!=''){
    	// $id=5;//圈子ID
    	// }
        $user_id=$user['userid'];//发布通知人
    	$this->view->setVar('circle_id',$id);
    	Tag::setTitle($this->session->get('object_name').' | 通知');
    	
    	$notice =new Notices();
    	$robots = $notice::find(array("circle_id='$id' and user_id='$user_id' and is_delete =0","order" => "notice_id desc"));
    	
    	$paginator =new Paginator(array(
    	"data"  => $robots,
    	"limit" => 5,
    	"page"  => $page
    	));
    	
    	//$page = $paginator->getPaginate();
    	//$this->view->setVar("page", $page);
    	//同下
    	$this->view->page = $paginator->getPaginate();
       	    	
    }
    
     /**
     * 发送新通知
     */
    public function sendAction()
    {
       // $page =$this->request->get('page');
       // if($page==""){
       	// $page=1;
       // }
		$user = $this->session->get('auth');
    	if (!$user) {
    		return $this->forward('session/index');
    	}
    	// $id=5;//圈子ID
        $user_id=$user['userid'];//发布通知人
    	
    	$request = $this->request;
		$circle_id = $request->getPost("circle_id");
		$this->view->setVar('circle_id',$circle_id);
     	$notice_title = $request->getPost('notice_title');
    	$receive =$request->getPost("receive");
		$receive=$receive=='N'?1:0;
    	$back = $request->getPost("back");
    	$content = $request->getPost("content");
		prin_r($_FILES);die;
    	if ($request->hasFiles() == true) {
    		foreach ($request->getUploadedFiles("notice_fujian") as $file){
	
    		$fujian =$this->upfile->upload_files(UPLOAD_FILE,$file);
    		$fujianname=$file->getName();
    		
    		}
    		
    	}else{
    		$fujian="no file";
    		$fujianname="no file";
    	}
    	//插入到通知数据库中
    	    	 
    	$notice = new Notices();
    	$notice->circle_id=$circle_id;
		$notice->user_id=$user['userid'];
		$notice->notice_title=$notice_title;
		$notice->receive_people=$receive;
		$notice->back=$back;
		$notice->content=$content;
		$notice->notice_fujian=$fujian;
		$notice->fujian_name = $fujianname;		
    	date_default_timezone_set('Asia/Shanghai');	// 上海时区

    	$notice->add_time=date("Y-m-d H:i:s");
    	$notice->is_delete=0;
    	if ($notice->save() == false) {
    		foreach ($notice->getMessages() as $message) {
    			$this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
    		}
    	}else{
    		//如果插入成功 判断是群接收还是指定人 在插入到另一张表里
    		if($receive==0){
    			$mems = Mcircle::find(array("circle_id = '$circle_id' and status=0"));
    			foreach ($mems as $mem) {
    				$nmember =new Nmember();
    				$nmember->circle_id=$circle_id;
    				$nmember->member_id=$mem->member_id;
    				$nmember->notice_id=$notice->readAttribute('notice_id');	// 获取notice插入id
    				$nmember->back=$back;
    				$nmember->isread=0;
    				$nmember->read_time="0000-00-00 00:00:00";
    				
    				if($nmember->save() ==false){
    					foreach($nmember->getMessages() as $message){
    						
    						$this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
    					 }
    				}
    			}
    		   		 $this->flash->success("发送成功");
    		    	 return $this->forward("notice/index");
    		}else{
    			
    			// $receive_people = $request->getPost("receive_people");
				$receive_people = $request->getPost("hdreceiveid");
    			$arr=explode(",",$receive_people);
    			foreach($arr as $u){
					$str =explode("*", $u);
					
					$nmember =new Nmember();
					$nmember->circle_id=$circle_id;
					$nmember->member_id=$str[1];
					$nmember->notice_id=$notice->readAttribute('notice_id');	// 获取notice插入id
					$nmember->back=$back;
					$nmember->isread=0;
					$nmember->read_time="0000-00-00 00:00:00";
					
					if($nmember->save() ==false){
						foreach($nmember->getMessages() as $message){
					
							$this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
						}
					}
					
    			}
    			$this->flash->success("发送成功");
    			
    			return $this->forward("notice/index");
    			
    		}
    	
    		
    	}
    	
  
    
    }
    /**
     * 修改通知
     */
    public function editAction($notice_id)
    {
    	$user = $this->session->get('auth');
    	if (!$user) {
    		return $this->forward('session/index');
    	}
    	//用于修改 与此模板相同 用一个action
    	
    	
      $notice = Notices::findFirst("notice_id = '$notice_id'");
      if($notice->receive_people ==1){
      	 
      	 $members = Nmember::find("notice_id ='$notice_id'");
      	 $people="";
      	 foreach ($members as $member) {
      	 	$people.=$member->getUsers()->name."*".$member->member_id.",";
      	 }
      	$people =substr($people,0,-1);
      }
    		
       $this->view->setVar('notice',$notice);
       $this->view->setVar('notice_id',$notice_id);
       $this->view->setVar('circle_id',$notice->circle_id);
	   $this->view->setVar('people',$people);
    }
    /**
     * 保存修改通知
     */
    public function saveAction($notice_id){
    	
    	$user = $this->session->get('auth');
    	if (!$user) {
    		return $this->forward('session/index');
    	}
    	
    	$notices = Notices::findFirst($notice_id);
    	if (!$notices) {
    		$this->flash->error("Notice was not found");
    		return $this->forward("notice/index");
    	}
    	
    	$request = $this->request;
  
    	$notice_title = $request->getPost('notice_title');
    	$circle_id = $request->getPost("circle_id");
    	$receive =$request->getPost("receive");
    	$back = $request->getPost("back");
    	$content = $request->getPost("content");
    	if ($request->hasFiles() == true) {
    		foreach ($request->getUploadedFiles("notice_fujian") as $file){
    	
    			$fujian =$this->upfile->upload_files(UPLOAD_FILE,$file);
    			$fujianname=$file->getName();
    			$notices->notice_fujian=$fujian;
    			$notices->fujian_name =$fujianname;
    	
    		}
    	
    	}
    	
    	//更新到通知数据库中
    	$notices->notice_title=$notice_title;
    	$notices->receive_people=$receive;
    	$notices->back=$back;
    	$notices->content=$content;
    	
    	date_default_timezone_set('Asia/Shanghai');	// 上海时区    	
    	$notice->add_time=date("Y-m-d H:i:s");
    	
    	if ($notices->save() == false) {
    		foreach ($notices->getMessages() as $message) {
    			$this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
    		}
    	}else{
    		//如果插入成功 判断删除所有的记录重新添加
    		
    		$members= Nmember::find(array("notice_id ='$notice_id'"));
    	
    		
    			if (!$members->delete()) {
    				foreach ($members->getMessages() as $message) {
    					$this->flash->error($message);
    				}
    				$this->flash->success("修改失败");
    	    	}
    		
    		if($receive==0){
    			$mems = Mcircle::find(array("circle_id = '$circle_id' and status=0"));
    			foreach ($mems as $mem) {
    				$nmember =new Nmember();
    				$nmember->circle_id=$circle_id;
    				$nmember->member_id=$mem->member_id;
    				$nmember->notice_id=$notice_id;	// 获取notice插入id
    				$nmember->back=$back;
    				$nmember->isread=0;
    				$nmember->read_time="0000-00-00 00:00:00";
    	
    				if($nmember->save() ==false){
    					foreach($nmember->getMessages() as $message){
    	
    						$this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
    					}
    				}
    			}
    			$this->flash->success("修改成功");
    		
    		}else{
    			 
    			$receive_people = $request->getPost("receive_people");
    			$arr=explode(",",$receive_people);
    			foreach($arr as $u){
    				$str =explode("*", $u);
    					
    				$nmember =new Nmember();
    				$nmember->circle_id=$circle_id;
    				$nmember->member_id=$str[1];
    				$nmember->notice_id=$notice_id;	// 获取notice插入id
    				$nmember->back=$back;
    				$nmember->isread=0;
    				$nmember->read_time="0000-00-00 00:00:00";
    					
    				if($nmember->save() ==false){
    					foreach($nmember->getMessages() as $message){
    							
    						$this->flash->error('<span style="color:#F00">'.(string) $message.'</span>');
    					}
    				}
    					
    			}
    			$this->flash->success("修改成功");
    			 
    			//return $this->forward("notice/index");
    			 
    		}
    }
    
    }
  /**
     * 删除通知
     */
    
    public function deleteAction()
	{
	    $notice_id = $this->request->get("id");
		$user = $this->session->get('auth');
		if (!$user) {
			return $this->forward('session/index');
		}
		$notices = Notices::findFirst($notice_id);
		if (!$notices) {
			$this->flash->error("Notice was not found");
			return $this->forward("notice/index");
		}
		
		$notices->is_delete=1;
		if (!$notices->save()) {
			foreach ($notices->getMessages() as $message) {
				$this->flash->error($message);
			}
			$this->flash->error("delete failed");
			return $this->forward('notice/index');
		}else{
			
			$this->flash->success("发送成功");
			
			return $this->forward("notice/index");
		}
       return  $this->forward("notice/index");
	
	}
	/**
	 * 查看通知的信息 和回执状况
	 */
	public function lookAction($id)
	{

		$user = $this->session->get('auth');
		if (!$user) {
			return $this->forward('session/index');
		}
		
		$notices =Notices::findFirst($id);
		$robots = Nmember::find(array("notice_id='$id'"));
    	$page =$this->request->get('page');
    	if($page==""){
    	
    		$page=1;
    	}
    	$paginator =new Paginator(array(
    	"data"  => $robots,
    	"limit" => 10,
    	"page"  => $page
    	));
    	
    	//$page = $paginator->getPaginate();
    	//$this->view->setVar("page", $page);
    	//同下
    	$this->view->setVar("notice_id", $id);
    	$this->view->setVar("notices",$notices);
    	$this->view->page = $paginator->getPaginate();
	
	}
	/**
	 * 下载文件
	 */
	public function downAction()
	{
	
		$user = $this->session->get('auth');
		if (!$user) {
			return $this->forward('session/index');
		}
		$file = $this->request->get("fujian"); // 要下载的文件
		ob_clean();
		header('Pragma: public');
		header('Last-Modified:'.gmdate('D, d M Y H:i:s') . 'GMT');
		header('Cache-Control:no-store, no-cache, must-revalidate');
		header('Cache-Control:pre-check=0, post-check=0, max-age=0');
		header('Content-Transfer-Encoding:binary');
		header('Content-Encoding:none');
		header('Content-type:multipart/form-data');
		header('Content-Disposition:attachment; filename="'.basename($file).'"'); //设置下载的默认文件名
		header('Content-length:'. filesize($file));
		$fp = fopen($file, 'r'); //读取数据，开始下载
		while(connection_status() == 0 && $buf = @fread($fp, 8192)){
			echo $buf;
		}
		fclose($fp);
		@flush();
		@ob_flush();
		exit();
		
	
	}
	/**
	 * 导出excel
	 */
	
	public function excelAction()
	{
		$user = $this->session->get('auth');
		if (!$user) {
			return $this->forward('session/index');
		}
		header('Content-Type: application/vnd.ms-excel'); //设置文件类型   也可以将 vnd.ms-excel' 改成xml（导出xml文件）
		header('Content-Disposition: attachment;filename="通知表.xls"'); //设置导出的excel的名字
		
		$id=$this->request->get('id');
		$robots = Nmember::find(array("notice_id='$id'"));
	$list='		
		<table>
				<tr>
		<td width="200">接收人</td>
		<td width="200">是否回执</td>
		<td width="200">是否阅读</td>
		<td width="200">阅读时间</td>
		<td width="200">回执内容</td>
		<td width="200">回执附件</td>
		</tr>';
     foreach ($robots as $robot){
     	if($robot->back==0)
     		$back="否";
     	else 
     		$back="是";
     	if($robot->isread ==0)
     		$read="否";
     	else 
     		$read="是";
     	
     	$list.=' <tr>
                   <td>'.$robot->getUsers()->name.'</td>
                   <td>'.$back.'</td>
                   <td>'.$read.'</td>
                   <td>'.$robot->read_time.'</td>    
                   <td>'.$robot->back_content.'</td>    
                   <td>'.$robot->back_fujianname.'</td>    
              </tr>';
     }
     $list.="</table>";
		echo $list;exit;
	}
	/**
	 * 导出附件
	 * 
	 */
	
	public function fujianAction()
	{   
		$user = $this->session->get('auth');
		if (!$user) {
			return $this->forward('session/index');
		}
		$id=$this->request->get('id');
		$robots = Nmember::find(array("notice_id='$id'"));
		
		$Path=array();
		foreach ($robots as $robot){
			
			if($robot->back_fujian!=""){
				$Path[]="../".$robot->back_fujian;
			}
			
		}
		
	    $ZipFile="../../notice.zip";
		$Todo=1;
		$Typ=2;
		$Path=Str_iReplace("\\","/",($Path));
		IF(Is_Null($Path) Or Empty($Path) Or !IsSet($Path)){Return False;}
		IF(Is_Null($ZipFile) Or Empty($ZipFile) Or !IsSet($ZipFile)){Return False;}
		
		IF(SubStr($Path,-1,1)=="/"){$Path=SubStr($Path,0,StrLen($Path)-1);}
		OB_end_clean();
		Switch ($Typ){
			Case "1":
				$this->phpzip->ZipDir($Path,$ZipFile,$Todo);
				Break;
			Case "2":
				$this->phpzip->ZipFile($Path,$ZipFile,$Todo);
				Break;
		}
		IF($Todo==1){
			Die();
		}Else{
			Return True;
		}
		
	}
     /**
     * 选择接收人
     */
    public function receivedAction($id)
    {
    	$user = $this->session->get('auth');
    	if (!$user) {
    		return $this->forward('session/index');
    	}
    	$page = 1;
    	
    	$name = $this->request->getPost("name");
    	if ($name!="") {
    		
    		$ids = Users::find(array("name like '%$name%'"));
    		$member_ids="";
    		//print_r($ids);exit;
    		foreach ($ids as $v){
    			$member_ids.=$v->userid;
    			$member_ids.=",";
    			
    		}
    		$member_ids =substr($member_ids,0,-1);
    		//$this->flash->notice($member_ids);exit;
    		$robots = Mcircle::find(array("circle_id = '$id' and status=0 and member_id in ($member_ids)"));
    	
    	} else {
    		$page = $this->request->get("page", "int");
    		$robots = Mcircle::find(array("circle_id = '$id' and status=0"));
    	}
    	
    	
    	if (count($robots) == 0) {
    		$this->flash->notice("No members are recorded");
    	
    	}

    	$paginator =new Paginator(array(
    			"data"  => $robots,
    			"limit" => 10,
    			"page"  => $page
    	));
    	 
    	//$page = $paginator->getPaginate();
    	$this->view->setVar("circle_id", $id);
    	//同下
    	$this->view->page = $paginator->getPaginate();
    	

    }

}
	