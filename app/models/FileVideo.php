<?php

class FileVideo extends Phalcon\Mvc\Model
{
	public $file_id;
	public $file_url;
	
	public function getSource()
	{
		return 'sns_file_video';
	}
	
	public function initialize()
	{
        $this->hasMany("file_id", "VideoSplit", "file_id");
    }
	

}
