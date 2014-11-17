<?php

class Area extends Phalcon\Mvc\Model
{
	public $id;
	public $name;

	public function getSource()
	{
		return 'sns_district';
	}

}