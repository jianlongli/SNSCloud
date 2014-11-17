<?php

class WorkCommit extends Phalcon\Mvc\Model
{
	public $commitid;
	public $userid;
	public $workid;
	public $name;
	public $size;
	public $type;
	public $localpath;
	public $url;
	public $created;
	
	public function getSource()
	{
		return 'sns_circle_work_commit';
	}
	
	public function initialize()
	{
//        $this->hasMany("workid", "Work", "workid");
	}
	
    
}
