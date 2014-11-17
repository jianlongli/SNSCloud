<?php

class Logs extends Phalcon\Mvc\Model
{
	public $userid;	// 用户id
	public $description;	// 描述
	public $gcloudid;	// 文件id
	public $ipaddress;	// ip地址
	public $createtime;	// 创建时间
	
	public function getSource()
	{
		return 'sns_cmm_logs';
	}
	
	public function initialize()
	{
	}
}
