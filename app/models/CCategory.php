<?php

/**
 * 圈子分类Model
 * @author Wanggh
 * 2014/11/28
 *
 */

class CCategory extends Phalcon\Mvc\Model {
	public $Id;
	public $circleId;
	public $categoryId;

	public function getSource()	{
		return 'sns_circle_category';
	}
}