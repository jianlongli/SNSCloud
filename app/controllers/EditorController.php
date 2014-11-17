<?php 
/*
* @link http://www.kalcaddle.com/
* @author warlee | e-mail:kalcaddle@qq.com
* @copyright warlee 2014.(Shanghai)Co.,Ltd
* @license http://kalcaddle.com/tools/licenses/license.txt
*/

class EditorController extends ControllerBase
{
	public function initialize()
    {
    	$config = new Phalcon\Config\Adapter\Ini(__DIR__.'/../config/config.ini');
		
//     	$HOST_NAME = 'http://'.$_SERVER['SERVER_NAME'];
		$HOST_NAME = 'http://192.168.0.102';
    	$this->view->setVar('HOST_NAME', $HOST_NAME);
    	
        parent::initialize();
    }
    
	// 多文件编辑器
	public function indexAction(){
	}
	
	// 单文件编辑
	public function editAction(){
		
		// 查询根路径
		$request = $this->request;
		if ($request->isGet() == true) {
			$filename = $request->get('filename');
		}
		
		// 查询被复制文件信息
		$gCloudfileManage = GCloudfileManage::findFirst("url='$filename'");
		$createtime = time();
		// 查询被复制文件信息
		$gLocalfileManage = GLocalfileManage::findFirst("fileid = '$gCloudfileManage->fileid'");
		$filePath = $gLocalfileManage->local;
		
		$this->view->setVar('filePath', $filePath);
		
		if (!is_readable($filePath)) $this->common->show_json('您没有此权限!', false);
		if (filesize($filePath) >= 1024*1024*20) $this->common->show_json('文件太大,不能大于20M', false);
		
		$filecontents = file_get_contents($filePath);	// 文件内容
		$charset = $this->_get_charset($filecontents);
		
		if ($charset!='' || $charset!='utf-8') {
			$filecontents = mb_convert_encoding($filecontents,'utf-8',$charset);
		}
		
		$data = array(
				'ext'		=> $this->file->get_path_ext($filePath),
				'name'      => $this->file->iconv_app($this->file->get_path_this($filePath)),
				'filename'	=> rawurldecode($filePath),
				'charset'	=> $charset,
				'content'	=> $filecontents
		);
		
		$this->view->setVar('htmlData', $data);
	}

	// 获取文件数据
	public function fileGetAction(){
		
		// 查询根路径
		$request = $this->request;
		if ($request->isGet() == true) {
			$filename = $request->get('filename');
		}

		if (!is_readable($filename)) $this->common->show_json('您没有此权限!', false);
		if (filesize($filename) >= 1024*1024*20) $this->common->show_json('文件太大,不能大于20M', false);
		
		$filecontents = file_get_contents($filename);	// 文件内容
		$charset = $this->_get_charset($filecontents);
		
		if ($charset!='' || $charset!='utf-8') {
			$filecontents = mb_convert_encoding($filecontents,'utf-8',$charset);
		}
		$data = array(
			'ext'		=> $this->file->get_path_ext($filename),
			'name'      => $this->file->iconv_app($this->file->get_path_this($filename)),
			'filename'	=> rawurldecode($filename),
			'charset'	=> $charset,
			'content'	=> $filecontents			
		);
		$this->view->show_json($data);
	}
	
	public function filesaveAction(){
		
		// 查询根路径
		$request = $this->request;
		if ($request->isPost() == true) {
			$filestr = rawurldecode($request->getPost('content'));
			$charset = $request->getPost('charset');
			$path = $request->getPost('path');
		}
		
		if (!is_writable($path)) $this->common->show_json('没有写入权限!',false);
		
		if ($charset !='' || $charset != 'utf-8') {
			$filestr = mb_convert_encoding($filestr,$charset,'utf-8');
		}
		$fp=fopen($path,'wb');
		fwrite($fp,$filestr);
		fclose($fp);
		
// 		$this->common->show_json('保存成功!');
		
		echo "<p style='color=#cc0000'>保存成功!</p>";
	}
	
	/*
	* 获取字符串编码
	* @param:$ext 传入字符串
	*/
	private function _get_charset(&$str) {
		if ($str == '') return 'utf-8';
		$charset=strtolower(mb_detect_encoding($str, 'ASCII,UTF-8,GBK'));
		if (substr($str,0,3)==chr(0xEF).chr(0xBB).chr(0xBF)){
			$charset='utf-8';
		}else if($charset=='cp936'){
			$charset='gbk';
		}
		if ($charset == 'ascii') $charset = 'utf-8';
		return strtolower($charset);
	}
}