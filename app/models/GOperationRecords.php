<?php

class GOperationRecords extends Phalcon\Mvc\Model
{
	public $gorid;			// 操作记录id
	public $cloudid;		// 云文件id
	public $operationid;	// 操作id
	public $createtime;		// 创建时间
	
	public function getSource()
	{
		return 'sns_g_operation_records';
	}
	
	public function initialize()
	{
        $this->hasOne("cloudid", "GCloudfileManage", "cloudid");
	}
	
    public function validation()
    {
        $this->validate(new UniquenessValidator(array(
            'field' => 'name',
            'message' => '文件名已存在'
        )));
        
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
