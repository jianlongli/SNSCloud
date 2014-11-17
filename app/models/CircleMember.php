<?php
class CircleMember extends Phalcon\Mvc\Model {

	public $Id;

	public $circle_id;

	public $member_id;

	public $type;

	public $time;

	public $status;

	public function getSource(){
		return 'sns_circle_member';
	}

}
