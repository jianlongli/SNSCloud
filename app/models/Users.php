<?php

use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;

class Users extends Phalcon\Mvc\Model
{
	public $userid;
	public $username;
	public $password;
	public $email;
	public $name;
	public $idnumber;
	public $phone;
	public $birthday;
	public $sex;
	public $question;
	public $answer;
	public $provinceid;
	public $cityid;
	public $county;
	public $classid;
	public $disciplineid;
	public $spacesize;
	public $status;
	public $created;
	public $avator;
	
	public function getSource()
	{
		return 'sns_member';
	}
	
	public function initialize()
	{
		$this->hasMany("userid", "UserRole", "user_id");
	}
	
    public function validation()
    {
        $this->validate(new EmailValidator(array(
            'field' => 'email'
        )));
        $this->validate(new UniquenessValidator(array(
            'field' => 'email',
            'message' => '抱歉，您的邮箱已被注册'
        )));
        $this->validate(new UniquenessValidator(array(
            'field' => 'username',
            'message' => '抱歉，您的用户名已被注册'
        )));
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
