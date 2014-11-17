<?php

class Common extends Phalcon\Mvc\User\Component
{	
	function test() {
		echo 'test';
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
	
	/**
	 *	返回用户初始化文件夹路径
	 */
	function set_user_path($userid) {
	
		$dir = array();
		$userid = sprintf("%09d", $userid);
		$dir[] = substr($userid, 0, 3);
		$dir[] = substr($userid, 3, 2);
		$dir[] = substr($userid, 5, 2);
		$dir = implode('/', $dir);
		$name = substr($userid, -2);
		$return = array($dir, $name);
	
		return $return;
	}
	
	// 获取客户端的IP地址
	function get_client_ip(){
	
		if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")){
			$ip = getenv("HTTP_CLIENT_IP");
		}else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")){
			$ip = getenv("HTTP_X_FORWARDED_FOR");
		}else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
			$ip = getenv("REMOTE_ADDR");
		else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
			$ip = $_SERVER['REMOTE_ADDR'];
		else
			$ip = "unknown";
	
		return($ip);
	}
	
	/*
	 函数名称：inject_check()
	 函数作用：检测提交的值是不是含有SQL注射的字符，防止注射，保护服务器安全
	 参　　数：$sql_str: 提交的变量
	 返 回 值：返回检测结果，ture or false
	 */
	function inject_check($sql_str) {
		return eregi('select|insert|and|or|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', $sql_str); // 进行过滤
	}
	
	/*
	 函数名称：verify_id()
	 函数作用：校验提交的ID类值是否合法
	 参　　数：$id: 提交的ID值
	 返 回 值：返回处理后的ID
	 */
	function verify_id($id=null) {
		if (!$id) { exit('没有提交参数！'); } // 是否为空判断
		elseif (inject_check($id)) { exit('提交的参数非法！'); } // 注射判断
		elseif (!is_numeric($id)) { exit('提交的参数非法！'); } // 数字判断
		$id = intval($id); // 整型化
	
		return $id;
	}
	
	/*
	 函数名称：str_check()
	 函数作用：对提交的字符串进行过滤
	 参　　数：$var: 要处理的字符串
	 返 回 值：返回过滤后的字符串
	 */
	function str_check( $str ) {
		if (!get_magic_quotes_gpc()) { // 判断magic_quotes_gpc是否打开
			$str = addslashes($str); // 进行过滤
		}
		$str = str_replace("_", "\_", $str); // 把 '_'过滤掉
		$str = str_replace("%", "\%", $str); // 把 '%'过滤掉
	
		return $str;
	}
	
	/*
	 函数名称：post_check()
	函数作用：对提交的编辑内容进行处理
	参　　数：$post: 要提交的内容
	返 回 值：$post: 返回过滤后的内容
	*/
	function post_check($post) {
		if (!get_magic_quotes_gpc()) { // 判断magic_quotes_gpc是否为打开
			$post = addslashes($post); // 进行magic_quotes_gpc没有打开的情况对提交数据的过滤
		}
		$post = str_replace("_", "\_", $post); // 把 '_'过滤掉
		$post = str_replace("%", "\%", $post); // 把 '%'过滤掉
		$post = nl2br($post); // 回车转换
		$post = htmlspecialchars($post); // html标记转换
	
		return $post;
	}
}