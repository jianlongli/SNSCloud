<?php
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;
class Company extends Phalcon\Mvc\Model {
	public $id;
	public $name;
	public $phone;
	public $createtime;
	public function getSource() {
		return 'sns_company';
	}
	public function initialize()
	{
		$this->hasMany("id", "RegionalCompany", "company_id");
	}
	public function validation()
	{
		$this->validate(new UniquenessValidator(array(
						'field' => 'name',
						'message' => '抱歉，单位名称已经存在'
						)));
		if ($this->validationHasFailed() == true) {
			return false;
		}
	}
}
