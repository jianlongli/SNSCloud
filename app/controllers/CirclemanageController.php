<?php

use Phalcon\Tag as Tag;

class CirclemanageController extends ControllerBase
{
	var $currentPage = 1;
	var $limit = 5;
	
	public function initialize()
	{
		$config = new Phalcon\Config\Adapter\Ini(__DIR__.'/../config/config.ini');
		$this->session->set('object_name', $config->object->object_name);
		parent::initialize();
		
		/*Loading public part*/
		$authInfo = $this->session->get('auth');
		if (!$authInfo) {
			return $this->forward('session/index');
		}
		
		$page = $this->request->get('page');
		$this -> currentPage = isset($page) && !empty($page) ? $page : $this-> currentPage;
		$pageSize = $this->request->get('pageSize');
		$this -> limit =  isset($pageSize) && !empty($pageSize) ? $pageSize : $this-> limit;
	}

	public function indexAction(){
		$request = $this->request;
		$circleId = $request->get('id');
		
                $circleList = Circle::find();
                $this->view->setVar('circleList',$circleList);

		$this->view->setTemplateAfter('topbar');   
		$this->view->setVar("circleId", $circleId);
	}
	/**
	 * Get circle infomation
	 */
	public function circleinfoAction(){
		
		$request = $this->request;
		$circleId = $request->get('id');
		if($circleId){
			$circleDetail = Circle::findFirst("circleid='$circleId'");
			$member0 = $member1 = $member2 = $member3 = $member0_id = $member1_id = $member2_id = $member3_id = '';
			if( count ( $circleDetail ) > 0 ){
				$sql = "SELECT Users.username username ,Users.userid userid, CircleMember.type type FROM CircleMember LEFT JOIN Users ON CircleMember.member_id = Users.userid WHERE CircleMember.circle_id='$circleId'";
				$memberList = $this->modelsManager->executeQuery ( $sql );
		
				foreach($memberList as $val){
					if($val->type == 0 ){
						$member0 .= $val->username.'  ';
						$member0_id .= $val->userid.',';
					}
					if($val->type == 1 ){
						$member1 .= $val->username.'  ';
						$member1_id .= $val->userid.',';	
					}
					if($val->type ==2 ){
						$member2 .= $val->username.'  ';
						$member2_id .= $val->userid.',';
					}
					if($val->type == 3){
						$member3 .= $val->username.'  ';
						$member3_id .= $val->userid.',';
					}
				}
				
				$circleInfo = array();
				$circleInfo['circleId'] = $circleId;
				$circleInfo['circlename'] = $circleDetail->name;
				$circleInfo['desc'] =  $circleDetail->desc;
				$circleInfo['logo'] = $circleDetail->logo ? '/circlestatic/img/circle/' . $circleDetail->circleid . '/' . $circleDetail->logo : '/circlestatic/images/7c.jpg';
				$circleInfo['member0'] =  $member0; /*普通成员*/
				$circleInfo['member1'] =  $member1; /*管理员*/
				$circleInfo['member2'] =  $member2; /*圈主*/
				$circleInfo['member3'] =  $member3; /*Experts*/
				$circleInfo['member0_id'] =  rtrim($member0_id, ',');
				$circleInfo['member1_id'] =  rtrim($member1_id, ',');
				$circleInfo['member2_id'] =  rtrim($member2_id, ',');
				$circleInfo['member3_id'] =  rtrim($member3_id, ',');
				$circleInfo['quanzhuId'] = $circleDetail->userid;
			}
			$this->view->setVar("circleInfo", $circleInfo);
		}
	}
	
	public function circleupdateAction(){
		$request = $this->request;
		$circleId = $request->getPost('circle_id');
		if($circleId){
			
			$logo = $request->getPost('qz_logo');
			$userid = $request->getPost('quanzhuId');
			$circlename = $request->getPost('circlename');
			$qz_admin_id = $request->getPost('qz_admin_id');
			
			/*Update circle infomation */
			$Circle = Circle::findFirst("circleid='$circleId'");
			$oldUserid = $Circle->userid;
			
			$circleModel = new Circle();
			$circleModel = $Circle;
			$circleModel->desc = $request->getPost('desc');
			$circleModel->istopic = $request->getPost('topic_flag');
			$circleModel->iscomment = $request->getPost('comment_flag');
			if($circlename)
				$circleModel->name = $circlename;
			if($logo){
				$circleModel->logo = $logo;
				$dir = dirname(__FILE__) . '/../../public/circlestatic/img/circle/' . $circleId . '/';
				$this->mkdirs($dir);
				@rename( dirname(__FILE__) . '/../../public/circlestatic/img/circle/tmp/' . $logo, $dir . $logo);
			}
			if(($userid != $oldUserid) && !empty($userid))
				$circleModel->userid = $userid;
			
			if ($circleModel->update() == false) {
				foreach ($circleModel->getMessages() as $message) {
					$this->common->show_json('Error : '.$message, false);
				}
			}
			
			/*Update circle master*/
			if(($userid != $oldUserid) && !empty($userid)){
				/*Old master change to member*/
				$message = $this->update_circle_member($circleId,$oldUserid);
				if($message !== true){
					$this->common->show_json('Error : '.$message, false);
				}
				
				/*Set up new master*/
				$message = $this->update_circle_member($circleId,$userid,2);
				if($message !== true){
					$this->common->show_json('Error : '.$message, false);
				}
				
			}
			
			/*Update circle admin*/
			$circleAdminlists = CircleMember::find(" circle_id='$circleId' and type=1 ");
			$newAdmins = array();
			$adminArr = explode(',' , $qz_admin_id);
			
			$existAdminArr = array();
			foreach ($circleAdminlists as $val){
					$existAdminArr[] = $val->member_id;
			}
			
			/*Remove exist adminId*/
			$updatetoAdmin = array_diff($adminArr, $existAdminArr);
			foreach($updatetoAdmin as $k => $v ){			
				$this->update_circle_member($circleId , $v ,1);
			}
			
			$updatetomember = array_diff($existAdminArr,$adminArr);
			foreach($updatetomember as $kk => $vv ){
				$this->update_circle_member($circleId , $vv ,0);
			}
			$this->common->show_json('success');
		}else{
			$this->common->show_json('error', false);
		}
	}
	
	/**
	 * Circle member manage
	 */
	public function membermanageAction(){
		
		$request = $this->request;
		$id = $request->getPost('id');
		$type = $request->getPost('type');
		
		if($id && $type){
			switch ($type){
				case 'cancelauthor':
					$message = $this->update_circlemember_by_id($id,0);
					break;
				case 'author':
					$message = $this->update_circlemember_by_id($id,1);
					break;
				case 'del':
					$message = $this->delete_circlemember_by_id($id);
					break;
				case 'info':
					break;
				case 'add':                                                                                           
                                          $memberId = $request->getPost('memberId');                                                    
                                          $message = $this->update_circle_member($id , $memberId, 0);                                   
                                          break;
			}
		}
		if($message === true)
			$this->common->show_json('Successful!');
		else 
			$this->common->show_json('Failt', false);	
		
	}
	
	/**
	 * Delete circle member relationship by relationId
	 * @param unknown $id
	 * @return boolean|string
	 */
	public function delete_circlemember_by_id( $id ){
		if(!$id)
			return false;
		$circleMember = CircleMember::findFirst("Id='$id'");
		if ($circleMember != false) {
			if ($circleMember->delete() == false) {
				foreach ($circleMember->getMessages() as $message) {
					return 'Error :'.$message;
				}
			} 
		}
		return true;
	}
	
	/**
	 * Update circle member relationship by relationId
	 * @param Int $id
	 * @param Int $type
	 * @param Int $status
	 */
	public function update_circlemember_by_id( $id , $type = '' , $status = '' ){
		if(!$id)
			return false;
		$circleMember = CircleMember::findFirst("Id='$id'");
		if($circleMember){
			$circleMemberModel = new CircleMember();
			$circleMemberModel = $circleMember;
			if($type !== ''){
				$circleMemberModel->type = $type;
			}
			if($status !== ''){
				$circleMemberModel->status = $status;
			}
				
			if ($circleMemberModel->update() == false) {
				foreach ($circleMemberModel->getMessages() as $message) {
					return 'Error : '.$message;
				}
			}
		}
		return true;
		
		
	}
	
	/**
	 * Update the circle members
	 * @param int $circleId circleId
	 * @param int $member_id memberId
	 * @param int $type 1:管理员； 2：圈主； 3：专家； 0：成员
	 * @return string|boolean
	 */
	public function update_circle_member($circleId , $member_id='',$type=0){
		
		if(empty($circleId) || empty($member_id))
			return 'Param error';
		
		$circleMember = CircleMember::findFirst("circle_id='$circleId' and member_id='$member_id'");
		
		if($circleMember){
			$circleMemberModel = new CircleMember();
			$circleMemberModel = $circleMember;
			$circleMemberModel->type = $type;
			if ($circleMemberModel->update() == false) {
				foreach ($circleMemberModel->getMessages() as $message) {
					return 'Error : '.$message;
				}
			}
		}else{
			$relation = new CircleMember();
			$relation->circle_id = $circleId;
			$relation->member_id = $member_id;
			$relation->type = $type;
			$relation->status = 0;
			$relation->time = time();
			$relation->save();
			foreach ($relation->getMessages() as $message) {
				return 'Error : '.$message;
			}
		}
		return true;		
	}
	
	public function memberAction(){
		/*status: 0:未处理 ； 1：确认 ； 2：未确认*/
		$request = $this->request;
		$circleId = $request->get('id');
		if($circleId){
			$keyWord = $request->get('key');
			$keyWord = empty($keyWord) ? '' : $keyWord;
			$searchCondition = "";
			if(!empty($keyWord)){
				$searchCondition .= "AND Users.username like '%$keyWord%'";
			}
			$sql = "SELECT CircleMember.Id id , CircleMember.type as type, CircleMember.status status , Users.username username, Users.userid userid FROM CircleMember LEFT JOIN Users ON CircleMember.member_id=Users.userid WHERE CircleMember.circle_id=$circleId $searchCondition";
			$memberlists = $this->modelsManager->executeQuery ( $sql );
			$existUserid = '';                                                                                            
                          foreach ($memberlists as $val){                                                                               
                                  $existUserid .= $val->userid. ',';                                                                   
                          }                                                                                                             
                          $existUserid = rtrim($existUserid,',');
			$page = $this->commoncircle -> get_page($memberlists,$this -> currentPage ,'/circlemanage/member',$this -> limit);
			$page ->  pageSize = $this->limit;
			$page->key = $keyWord;
		}
		$this->view->setVar("page",$page );
		
	}
	
	public function expertsAction(){
		$request = $this->request;
		$circleId = $request->get('id');
		$circleId = $circleId ? $circleId : 0;
		if($circleId){
			$sql = "SELECT CircleMember.Id id , CircleMember.type as type, CircleMember.status status , Users.username username, Users.userid userid,Users.password password FROM CircleMember LEFT JOIN Users ON CircleMember.member_id=Users.userid WHERE CircleMember.circle_id=$circleId And CircleMember.type=3 order by id desc ";
			$expertlists = $this->modelsManager->executeQuery ( $sql );
			//$page = $this->commoncircle -> get_page($expertlists,$this -> currentPage ,'/circlemanage/member',$this -> limit);
			$circle = Circle::findfirst (' circleid=' . $circleId);
		}
		$this->view->setVar("expertlists",$expertlists );
		$this->view->setVar ('circleName', $circle ? $circle->name : '');
		$this->view->setVar ('circleId', $circleId);
	}
	
	public function infoAction(){
	
	
	}
	/**
	 * 递归创建目录
	 * @param $dir
	 */
	public function mkdirs($dir) {
		if(!is_dir($dir)){
			if( ! mkdirs(dirname($dir))){
				return false;
			}
			if( ! mkdir($dir,0777))	{
				return false;
			}
		}
		return true;
	}
}
