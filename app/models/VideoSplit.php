<?php


class VideoSplit extends Phalcon\Mvc\Model
{
	public $video_id;
	public $file_id;
	public $video_name;
	public $video_start;
	public $video_end;
	public $video_description;
	public $video_userid;
	public $video_addtime;
	
	public function getSource()
	{
		return 'sns_video_split';
	}
	
	public function initialize()
	{
        $this->belongsTo("file_id", "FileVideo", "file_id");
        $this->belongsTo("video_userid", "Users", "userid");
        $this->hasMany("video_id", "VideoPinglun", "video_id");
        $this->hasMany("video_id", "VideoTuijian", "video_id");
     }
	

}
