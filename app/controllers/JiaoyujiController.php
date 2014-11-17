<?php

class JiaoyujiController extends ControllerBase
{
    public function initialize()
    {
        Phalcon\Tag::setTitle('Jiaoyuji us');
        parent::initialize();
    }

    public function indexAction()
    {
    	$user = $this->session->get('path_copy');
    	 
    	echo "<pre>";
    	print_r($user);
    	exit;
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
}