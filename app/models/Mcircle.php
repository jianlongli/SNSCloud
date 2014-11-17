<?php

use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;

class Mcircle extends Phalcon\Mvc\Model
{
	public $Id;
	public $circle_id;
	public $member_id;
	public $type;
	public $time;
	public $status;
	
	public function getSource()
	{
		return 'sns_circle_member';
	}
	
	public function initialize()
	{
        $this->belongsTo("circle_id", "sns_circle", "circleid");
        $this->belongsTo("member_id","Users","userid");
	}
	

}
