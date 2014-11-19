<?php 

use Phalcon\Tag as Tag;

class VideoController extends ControllerBase
{

    public function initialize()
    {
    	$config = new Phalcon\Config\Adapter\Ini(__DIR__.'/../config/config.ini');
    	$this->session->set('object_name', $config->object->object_name);
		    	    	
        parent::initialize();
    }
    /**
     * 视频首页
     */

    public function indexAction()
    {
    
        $user = $this->session->get('auth');
    	if (!$user) {
    		return $this->forward('session/index');
    	}
    	
        $user_id=$user['userid'];//当前userID
    	//$this->view->setVar('circle_id',$id);
    	Tag::setTitle($this->session->get('object_name').' | 视频');
    	
    }
    /**
     * 
     * 删除切片
     */
    public function delAction(){
    	
    	$user = $this->session->get('auth');
    	if (!$user) {
    		return $this->forward('session/index');
    	}
    	$id=$_POST['id'];
    	$videos =VideoSplit::findFirst(array("video_id='$id'"));
		
		if($videos->delete()){
			echo 1;
		}

    	
    }
    
    /**
     * 下载文件
     */
    public function downAction()
    {
       //下载文件时 应该在下载次数中+1 并且在资源轨迹中显示谁下载了此文件
       
    	$user = $this->session->get('auth');
    	if (!$user) {
    		return $this->forward('session/index');
    	}
    	$file = $this->request->get("url"); // 要下载的文件
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
     * 视频切割页面
     */
    public function splitAction()
    {
    
    	$file_id=1;
    	$user = $this->session->get('auth');
    	if (!$user) {
    		return $this->forward('session/index');
    	}
    	 
    	$user_id=$user['userid'];//当前userID
    	$this->view->setVar('file_id',$file_id);
    	
    	Tag::setTitle($this->session->get('object_name').' | 视频');
    	
    	$file =FileVideo::findFirst(array("file_id='$file_id'"));
    	$page = VideoSplit::find(array("file_id = '$file_id'"));
    	$tui =VideoTuijian::find(array("file_id='$file_id' and video_id=0"));
    	$zhuanjiapinglun = VideoPinglun::find(array("file_id='$file_id' and video_id=0 and is_expert=1"));
    	
    	$pinglun="<marquee direction='left'>";
    	foreach ($zhuanjiapinglun as $ping){
    		
    		$pinglun.=$ping->getUsers()->name." : ".$ping->pinglun."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    	}
    	$pinglun .="</marquee>";
    	
    	$qita="";
    	foreach ($page as $lun){
    		
    		$pings =VideoPinglun::find(array("file_id='$file_id' and video_id='$lun->video_id' and is_expert=1"));
    		 $qita.="<div id='$lun->video_id' style='display:none'><marquee direction='left'>";
                   foreach ($pings as $ping){
                   	
                   	 	$qita.=$ping->getUsers()->name." : ".$ping->pinglun."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                   }         
                            
              $qita.="</marquee></div>";
    	}
    	$tuijian =count($tui);
    	$this->view->setVar('tuijian',$tuijian);
    	$this->view->setVar('page',$page);
    	$this->view->setVar('qita',$qita);
    	$this->view->setVar('zhuanjiapinglun',$pinglun);
    	$this->view->setVar('file_url',$file->file_url);
    }
    /**
     * 发表评论
     * 
     */
    
    public function pinglunAction(){
    	
    	$user = $this->session->get('auth');
    	if (!$user) {
    		return $this->forward('session/index');
    	}
    	$user_id=$user['userid'];//当前userID
    	$video_id=$_POST['qiepian_id'];
    	$file_id=$_POST['file_id'];
    	$pingluns=$_POST['pingluns'];
    	$is_expert=1;// 这个要从数据库里面判断此人是否是专家 不是为0是 为1  暂时为专家 后期判断
    	$add_time=date("Y-m-d H:i:s");
    	if($video_id==""){
    		$video_id=0;   	
    	}
    	
    	$pinglun =new VideoPinglun();
    	$pinglun->video_id=$video_id;
    	$pinglun->user_id=$user_id;
    	$pinglun->add_time=$add_time;
    	$pinglun->file_id=$file_id;
    	$pinglun->pinglun=$pingluns;
    	$pinglun->is_expert=$is_expert;
    
    	if($pinglun->save()){
    		
    		echo "@#*yes@#*";
    	}else{
    		echo "@#*error@#*";
    	}
    }
    
   /**
    * 点击推荐的请求处理
    * 
    */
    
    public function tuijianAction(){
    	
    	$user = $this->session->get('auth');
    	if (!$user) {
    		return $this->forward('session/index');
    	}
    	$user_id=$user['userid'];//当前userID
    	$video=$_POST['video_id'];
    	if($video!=""){
    	
    		$tuijian =VideoTuijian::find(array("video_id ='$video' and user_id='$user_id'"));
    		echo "@#*".count($tuijian)."@#*";exit;
    	}
    	
    	
    	$video_id=$_POST['qiepian_id'];
    	$file_id=$_POST['file_id'];
    	$add_time=date("Y-m-d H:i:s");
    	
    	if($video_id==""){    		
    		$video_id=0;    		
    	}
    	
    	$tuijian =VideoTuijian::find(array("user_id='$user_id' and video_id ='$video_id' and file_id ='$file_id'"));
    
    	if(count($tuijian)== 0){
    		
    		$tui = new VideoTuijian();
    		$tui->file_id=$file_id;
    		$tui->video_id=$video_id;
    		$tui->user_id=$user_id;
    		$tui->add_time=$add_time;
    		
    		if($tui->save()){
    			
    			echo "@#*yes@#*";
    		}
    	}else{
    		echo "@#*error@#*";
    		
    	}
    }
    /**
     * 切片保存
     */
    public function sendAction(){
    	
    	 $user = $this->session->get('auth');
    	if (!$user) {
    		return $this->forward('session/index');
    	}
    	
    	$user_id=$user['userid'];//当前userID
		$start=$_POST['one'];
		$end = $_POST['two'];
		$name =$_POST['name'];
		$content=$_POST['content'];
		$file_id=$_POST['file_id'];
		$add_time=date("Y-m-d H:i:s");
      
		$split = new VideoSplit();
		$split->file_id =$file_id;
		$split->video_name=$name;
		$split->video_start=$start;
		$split->video_end=$end;
		$split->video_description=$content;
		$split->video_userid=$user_id;
		$split->video_addtime=$add_time;
		

		if ($split->save()) {
			
			//获取最后插入的video_id
			$split_id=$split->readAttribute('video_id');	// 获取最后插入id
			echo "@#*".$split_id."@#*";
		}else{
			
			echo "@#*error@#*";
		}  
    	
    	
     
    }
    
   

}
	