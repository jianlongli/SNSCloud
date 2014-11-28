<?php

/**
 * 圈子分类Model
 * @author Wanggh
 * 2014/11/28
 *
 */
class Category extends Phalcon\Mvc\Model {
	public $Id;
	public $name;
	public $parentId;

	public function getSource()	{
		return 'sns_category';
	}
}