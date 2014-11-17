<?php
class Customer extends Phalcon\Mvc\Model {
	public $id;
	public $name;
	public function getSource() {
		return 'sns_customer';
	}
}