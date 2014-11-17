<?php

class UserRole extends Phalcon\Mvc\Model
{
	public $user_id;
	public $role_id;
	
	public function getSource()
	{
		return 'sns_role_user';
	}
	
	public function initialize()
	{
        $this->hasOne("user_id", "Users", "userid");
        $this->belongsTo("role_id", "Role", "id");
	}
}
