<?php

/**
 * 讨论Model
 * @author Wanggh
 *
 */
class Topic extends Phalcon\Mvc\Model {
	public $topicid;
	public $userid;
	public $title;
	public $description;
	public $attachment;
	public $size;
	public $type;
	public $localpath;
	public $url;
	public $status;
	public $created;
	public $circleId;
	
	public function getSource() {
		return 'sns_discussion_topic';
	}
	
	
    
   
	
    
}
