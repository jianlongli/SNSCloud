<?php

use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;

class FilenameExtension extends Phalcon\Mvc\Model
{
	public $extid;			// 扩展名id
	public $name;			// 扩展名
	public $category;		// 扩展名类别
	public $description;	// 扩展名描述
	
	public function getSource()
	{
		return 'sns_filename_extension';
	}
}
