<?php

class VideoTuijian extends Phalcon\Mvc\Model
{
	public $tuijian_id;
	public $file_id;
	public $video_id;
	public $user_id;
	public $add_time;
	
	public function getSource()
	{
		return 'sns_video_tuijian';
	}
	
	public function initialize()
	{
        $this->belongsTo("file_id", "FileVideo", "file_id");
        $this->belongsTo("video_id", "VideoSplit", "video_id");
        $this->belongsTo("user_id", "Users", "userid");
    }
	

}
