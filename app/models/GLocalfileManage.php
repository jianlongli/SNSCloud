<?php

use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;

class GLocalfileManage extends Phalcon\Mvc\Model
{
	public $fileid;	// 文件id
	public $userid;	// 用户id
	public $name;	// 文件名称
	public $tags;	// 标签
	public $size;	// 大小
	public $type;	// 类型
	public $local;	// 本地路径
	public $url;	// 访问路径
	public $status;	// 状态（0显示，1隐藏）
	public $modifytime;	// 修改时间
	public $createtime;	// 创建时间
	
	public function getSource()
	{
		return 'sns_cmm_localfile_manage';
	}
	
	public function initialize()
	{
        $this->hasOne("fileid", "GCloudfileManage", "fileid");
	}
}
