<?php

use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;

class Circle extends Phalcon\Mvc\Model
{
	public $circleid;
	public $name;
	public $userid;
	public $company_id;
	public $desc;

	public function getSource()
	{
		return 'sns_circle';
	}

	public function validation()
	{
		$this->validate(new UniquenessValidator(array(
						'field' => 'name',
						'message' => '抱歉，您的圈子名已经存在'
						)));
		if ($this->validationHasFailed() == true) {
			return false;
		}
	}





}
