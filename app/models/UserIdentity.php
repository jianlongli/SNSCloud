<?php
class UserIdentity extends Phalcon\Mvc\Model
{
	public $id;
	public $name;
	
	public function getSource()
	{
		return 'sns_user_identity';
	}

}