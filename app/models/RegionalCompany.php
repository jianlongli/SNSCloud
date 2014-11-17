<?php

class RegionalCompany extends Phalcon\Mvc\Model
{
	public $regional_id;
	public $company_id;

	public function getSource()
	{
		return 'sns_regional_company';
	}

	public function initialize()
	{
		$this->hasOne("company_id", "Company", "id");
		$this->belongsTo("regional_id", "Regional", "id");
	}
}