<?php

use Phalcon\Tag as Tag;

class SettingController extends ControllerBase
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
    
    public function setAction($key, $value)
    {	
        if ($key !='' && $value != '') {
        	// Todo: 数据库数据表取得
            $conf = Array(
            		'list_type' => 'icon',
    				'list_sort_field' => 'name',
    				'list_sort_order' => 'up',
    				'theme' => 'metro/',
    				'codetheme' => 'crimson_editor',
    				'wall' => '2',
    				'musictheme' => 'qqmusic',
    				'movietheme' => 'webplayer'
            );
        
            $arr_k = explode(',', $key);
            $arr_v = explode(',',$value);
            $num = count($arr_k);

            for ($i=0; $i < $num; $i++) { 
                $conf[$arr_k[$i]] = $arr_v[$i];
            }
 			
            
            $this->session->set('app_startTime', parent::mtime());         //起始时间
 
//             fileCache::save($this->config['user_seting_file'],$conf);	Todo: 存至数据库
            parent::show_json("修改已生效！");
        }else{
            parent::show_json('失败',false);
        }
    }
}
