<?php

use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;

class CircleCloudfileManage extends Phalcon\Mvc\Model
{
	public $gcloudid;	// 云文件id
	public $parenturl;	// 上级路径
	public $name;	// 文件名称
	public $oldurl;	// 原始路径
	public $url;	// 访问路径
	public $fileid;	// 文件id
	public $userid;	// 用户id
	public $ext;	// 扩展名
	public $type;	// 类型
	public $accesstimes;	// 查看次数
	public $isencryption;	// 加密（0否，1是）
	public $isreadable;		// 可读性（1可读，0不可读）
	public $iswriteable;	// 可写性（1可写，0不可写）
	public $size;			// 文件大小
	public $sizefriendly;	// 文件大小（带单位）
	public $status;			// 状态（0显示，1隐藏）
	public $lastaccesstime;	// 最后访问时间
	public $modifytime;		// 修改时间
	public $createtime;		// 创建时间

	public function getSource()
	{
		return 'sns_circle_cloudfile_manage';
	}

	public function initialize()
	{
		$this->hasOne("fileid", "GLocalfileManage", "fileid");
		$this->hasMany("cloudid", "GOperationRecords", "cloudid");
	}

	public function validation()
	{
		$this->validate(new UniquenessValidator(array(
						'field' => 'url',
						'message' => '文件名已存在'
						)));

		if ($this->validationHasFailed() == true) {
			return false;
		}
	}
}
