<?php

class ControllerBase extends Phalcon\Mvc\Controller
{

    protected function initialize()
    {
        Phalcon\Tag::prependTitle('教育即 | ');
    }

    protected function forward($uri){
    	$uriParts = explode('/', $uri);
    	return $this->dispatcher->forward(
    		array(
    			'controller' => $uriParts[0], 
    			'action' => $uriParts[1]
    		)
    	);
    }
    
    /**
     * 获取精确时间
     */
    function mtime(){
    	$t= explode(' ',microtime());
    	$time = $t[0]+$t[1];
    	return $time;
    }
    
    /**
     * 打包返回AJAX请求的数据
     * @params {int} 返回状态码， 通常0表示正常
     * @params {array} 返回的数据集合
     */
    function show_json($data,$code = true,$info=''){
    	$use_time = $this->mtime() - $this->session->get('app_startTime');
    	$result = array('code' => $code,'use_time'=>$use_time,'data' => $data);
    	if ($info != '') {
    		$result['info'] = $info;
    	}
    	header('Content-Type: application/json; charset=utf-8');
    	echo json_encode($result);
    	exit;
    }
}
