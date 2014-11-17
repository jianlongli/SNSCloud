<?php

class Work extends Phalcon\Mvc\Model
{
	public $workid;
	public $userid;
	public $circleid;
	public $title;
	public $starttime;
	public $endtime;
	public $description;
	public $created;
	public $receiveid;
	
	public function getSource()
	{
		return 'sns_circle_work';
	}
	
	public function initialize()
	{
        //$this->hasMany("workid", "WorkCommit", "workid");
	}
	
    
   
	
    
}
