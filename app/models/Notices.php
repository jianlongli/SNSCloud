<?php

use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;

class Notices extends Phalcon\Mvc\Model
{
	public $notice_id;
	public $circle_id;
	public $user_id;
	public $notice_title;
	public $receive_people;
	public $back;
	public $content;
	public $noctice_fujian;
	public $fujian_name;
	public $add_time;
	public $is_delete;
	
	public function getSource()
	{
		return 'sns_notice';
	}
	
	public function initialize()
	{
        $this->hasMany("notice_id", "Nmember", "notice_id");
        $this->belongsTo("circle_id","Mcircle","circle_id");
	}
	

}
