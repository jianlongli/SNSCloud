<?php

class Role extends Phalcon\Mvc\Model
{
	public $id;
	public $name;
	
	public function getSource()
	{
		return 'sns_role';
	}
	
	public function initialize()
	{
		$this->hasMany("id", "UserRole", "role_id");
	}
}
