<?php
use Phalcon\Tag as Tag;

class DiscussionController extends ControllerBase
{	
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
    }

    public function indexAction(){
    	Tag::setTitle($this->session->get('object_name').' | 发起讨论');
    }
    
}