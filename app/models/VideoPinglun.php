<?php


class VideoPinglun extends Phalcon\Mvc\Model
{
	public $pinglun_id;
	public $video_id;
	public $user_id;
	public $add_time;
	public $file_id;
	public $pinglun;
	public $is_expert;
		
	public function getSource()
	{
		return 'sns_video_pinglun';
	}
	
	public function initialize()
	{
        $this->belongsTo("file_id", "FileVideo", "file_id");
        $this->belongsTo("user_id", "Users", "userid");
        $this->belongsTo("video_id", "VideoSplit", "video_id");
     }
	

}
