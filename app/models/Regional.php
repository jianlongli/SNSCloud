<?php
class Regional extends Phalcon\Mvc\Model {
	public $id;
	public $name;
	public function getSource() {
		return 'sns_regional';
	}
	public function initialize()
	{
		$this->hasMany("id", "RegionalCompany", "regional_id");
	}
}