<?php

use Phalcon\Tag as Tag;

class DiscussController extends ControllerBase
{
	var $pageSize = 100;//分页条数
	public function initialize()
	{
		$config = new Phalcon\Config\Adapter\Ini(__DIR__.'/../config/config.ini');
		$this->session->set('object_name', $config->object->object_name);

		parent::initialize();
	}

	public function discussaddAction()
	{
		$circleid=$this->request->get('circleid');
		$type=$this->request->get('type');
		$user = $this->session->get('auth');
		if($type=="submit"){
			$title = $this->request->get('title');
			$content = $this->request->get('content');
			$createtime = time();
			$discuss = new Discuss();
			if(!empty($discussid)){
				$discuss->id = $discussid;
			}
			
			$discuss->circleid = $circleid;
			$discuss->title = $title;
			$discuss->content = $content;
			$discuss->createtime = $createtime;
			$discuss->userid = $user['userid'];
			// $discuss->dirid = "";
			$discuss->state = 0;
			if($discuss->save() == false){
				foreach($discuss->getMessages() as $message){
					$this->common->show_json($message,false);
				}
			}else{
			
			
			}
		}
	}
	
	
		
}
	
	




}