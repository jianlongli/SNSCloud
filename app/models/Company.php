<?php
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
}
