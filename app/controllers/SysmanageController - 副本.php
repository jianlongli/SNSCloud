<?php

use Phalcon\Tag as Tag;

class SysmanageController extends ControllerBase
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
		$this->view->setTemplateAfter('topbar');	
		Tag::setTitle($this->session->get('object_name').' | Sysmanage');
	}
	
	public function showAction($aciotn = 'index'){
		
		switch ($aciotn){
			case 'invite' :
				break;
			case 'member' :
				break;
			case 'company' :
				break;
			case 'customer' :
				break;
			case 'circle' :
				break;
			case 'setting' :
				break;
			case 'log' :
				break;
			default:
				break;
		}
		$this->common->show_json('OK');
	}
	
	
}