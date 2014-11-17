<?php

/**
 * 讨论Model
 * @author Wanggh
 *
 */
class Topicreply extends Phalcon\Mvc\Model {
	public $commentid;
	public $topicid;
	public $userid;
	public $content;
	public $attachment;
	public $size;
	public $type;
	public $localpath;
	public $url;
	public $status;
	public $created;
	
	public function getSource() {
		return 'sns_discussion_comment';
	}
	
	
    
   
	
    
}
