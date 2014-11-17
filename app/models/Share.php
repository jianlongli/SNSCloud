<?php

class Share extends Phalcon\Mvc\Model
{
	public $shareid;
	public $cloudid;
	public $ccloudid;
	public $userid;
	public $useredid;
	public $filename;
	public $fileurl;
	public $sharelink;
	public $isencryption;
	public $password;
	public $status;
	public $createtime;
	
	public function getSource()
	{
		return 'sns_cmm_share';
	}
	
	public function initialize()
	{
//         $this->hasOne("userid", "UserRole", "userid");
	}
}
