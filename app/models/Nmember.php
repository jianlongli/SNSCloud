<?php

use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;

class Nmember extends Phalcon\Mvc\Model
{
	public $id;
	public $circle_id;
	public $member_id;
	public $notice_id;
	public $back;
	public $isread;
	public $read_time;
	public $back_content;
	public $back_fujianname;
	public $back_fujian;
	
	public function getSource()
	{
		return 'sns_notice_member';
	}
	
	public function initialize()
	{
        $this->belongsTo("notice_id", "Notices", "notice_id");
        $this->belongsTo("member_id", "Users", "userid");
    }
	

}
