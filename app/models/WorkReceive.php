<?php

class WorkReceive extends Phalcon\Mvc\Model
{
	public $id;
	public $workid;
	public $userid;
	public $iscommit;
	
	public function getSource()
	{
		return 'sns_circle_work_receive';
	}
	
	public function initialize()
	{
        $this->hasMany("workid", "Work", "workid");
	}
	
    
   
	
    
}
