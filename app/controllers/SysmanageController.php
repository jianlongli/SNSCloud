<?php

use Phalcon\Tag as Tag;

class SysmanageController extends ControllerBase
{
	var $userid = 0;
	var $username = "";
	var $roleids = "";
	
	var $currentPage = 1;
	var $limit = 3;
	
	var $pageSizeArr = array(5,8,10);
	
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
		
		$this -> userid = $authInfo['userid'];
		$this -> username = $authInfo['username'];
		$this -> roleids = $authInfo['roleids'];
			
		$page = $this->request->get('page');
		$this -> currentPage = isset($page) && !empty($page) ? $page : $this-> currentPage;
		$pageSize = $this->request->get('pageSize');
		$this -> limit =  isset($pageSize) && !empty($pageSize) ? $pageSize : $this-> limit;
	}
	
	/**
	 * Personal information 
	 */
	public function indexAction( )
	{
		if (!$this->session->get('auth')) {
			return $this->forward('session/index');
		}
		$this->view->setTemplateAfter('topbar');
		Tag::setTitle($this->session->get('object_name').' | 圈子');
	}
	
	/**
	 * Personal information
	 * @param string $option
	 * @param number $id
	 */
	public function personalAction( $option = '', $id = 0 ){
		
		$request = $this->request;
		$passwordFlag = false;
		
		if ($option == 'update'){
			if ($request->isPost()) {
				if ($request->isAjax() == true) {
					/*Request data*/
					$password = $request->getPost('password');
					$repassword = $request->getPost('repassword');
					$email = $request->getPost('email');
					$phone = $request->getPost('phone');
					$birthday = $request->getPost('birthday');
					$sex = $request->getPost('sex');
					$provinceid = $request->getPost('provinceid');
					$cityid = $request->getPost('cityid');
					$county = $request->getPost('county');
					$avator = $request->getPost('avator');
			
					if(!empty($password) || !empty($repassword) ){
						if ($password != $repassword) 
							$this->common->show_json('The passwords entered are not the same. Please re-enter them',false );
						$passwordFlag = true;
					}
			
					$userDetail = Users::findFirst("userid='$this->userid'");
					$UserModel = new Users();
					$UserModel = $userDetail;
					
					$UserModel->email = isset($email) ? $email : '';
					$UserModel->phone = isset($phone) ? $phone : '';
					$UserModel->birthday = isset($birthday) ? $birthday : '';
					$UserModel->sex = $sex;
					$UserModel->provinceid = isset($provinceid) ? $provinceid : '';
					$UserModel->cityid = isset($cityid) ? $cityid : '';
					$UserModel->county = isset($county) ? $county : '';
					$UserModel->created = time();
					$UserModel->avator = isset($avator) ? $avator : '';
					
					if($passwordFlag)
						$UserModel->password = $password;
					
					if ($UserModel->update() == false) {
						foreach ($UserModel->getMessages() as $message) {
							$this->common->show_json($message, false);
						}
					}
					$this->common->show_json('Successful');
				}
			}
			$this->common->show_json('Illegal request',false);
		}else{
			$userDetail = Users::findFirst("userid='$this->userid'");
			
			if (empty($userDetail))
				$this->common->show_json('Personal information is empty ! ',false);
			$this->common->show_json($userDetail);
		}
	}
	
	/**
	 * Invite manage
	 */
	public function inviteAction( $option = '', $id = 0 )
	{
		$allowArr = array( 'update', 'del', 'add');
		$option = in_array($option, $allowArr) ? $option : '';
		$request = $this->request;
		
		if ($option == 'update') {
			
			$id = $request->get('id');
			$type = $request->get('type');
			
			if($id && $type){
				
				$circleMember = CircleMember::findFirst("Id='$id'");
				$circleMemberModel = new CircleMember();
				$circleMemberModel = $circleMember;
				$status = $type == 'y' ? 1 : ($type == 'n' ? 2 : 0 ); 
				$circleMemberModel-> status = $status;
				if ($circleMemberModel->update() == false) {
					foreach ($circleMemberModel->getMessages() as $message) {
						$this->common->show_json('Error : '.$message, false);
					}
				}
				$this->common->show_json('Successful');
			}else{
				$this->common->show_json('Illgal request');
			}
			
		}else{
			/*The search condition*/
			$keyWord = $request->get('key');
			$keyWord = empty($keyWord) ? '' : $keyWord;
			$searchCondition = "";
			if(!empty($keyWord)){
				$searchCondition .= "AND Circle.name like '%$keyWord%'";
			}
			$phql = "SELECT Circle.circleid circleid, CircleMember.Id id , Circle.name circlename,Users.username username,CircleMember.time time, CircleMember.status status FROM CircleMember LEFT JOIN Circle ON Circle.circleid=CircleMember.circle_id LEFT JOIN Users ON Users.userid=Circle.userid WHERE CircleMember.member_id='$this->userid' $searchCondition";
			$Invite = $this->modelsManager->executeQuery ( $phql );
			$page = $this->commoncircle -> get_page($Invite,$this -> currentPage ,'/sysmanage/invite',$this -> limit);
			$page ->  pageSize = $this->limit;
			$page -> key = $keyWord;
				
			if(count($Invite)>0){
				foreach($page->items as $key => $val){
					$val->formartTime = (date('Y-m-d',$val->time));
				}
				$this->common->show_json($page);
			}else{
				$arr = array('key'=>$keyWord);
				$this->common->show_json((object)$arr,false);
			}			
		}
		$this->common->show_json('fdsafdsa');
	}
	
	/**
	 * Member manage
	 * @param string $option
	 * @param number $id
	 */
	public function memberAction($option = '', $id = 0)
	{
		$allowArr = array( 'edit', 'del', 'add');
		$option = in_array($option, $allowArr) ? $option : '';
		$request = $this->request;
		
		if ($option == 'edit') {
			
		} elseif ($option == 'del') {
			if ($request->isAjax() == true) {
				
				$ids = $request->getPost('id');
	
				if($ids == ''){
					$this->common->show_json('Illegal request !');
				}
				
				if( strrpos($ids , ',') === false){
					$this->common->show_json('Param is error !');
				}
				
				$ids = substr($ids,0,strlen($ids)-1);
				
				//Delete users data
				foreach(Users::find("userid in($ids)") as $user){
					if($user->delete() == false){
						foreach($user->getMessages() as $message){
							$this->common->show_json('Error '.$message,false);
						}
					}
				}
				//Delete user and role relation
				foreach(UserRole::find("user_id in('$ids')") as $userrole){
					if($userrole->delete() == false){
						foreach($userrole->getMessages() as $message ){
							$this->common->show_json('Error : '.$message,false);
						}
					}
				}
				$this->common->show_json('Delete user successful!');
			}
		} elseif ($option == 'add') {
			if ($request->isAjax() == true) {
				/*Request data*/
				$username = $request->getPost('username');
				$password = $request->getPost('password');
				$repassword = $request->getPost('repassword');
				$email = $request->getPost('email');
				$role_id = $request->getPost('role_id');
				$identity = $request->getPost('identity');
				$sex = $request->getPost('sex');
				$name = $request->getPost('name');
				$cityid = $request->getPost('company');
				
				if(empty($role_id)){
					$this->common->show_json('Please choose role !',false);
				}
				
				if(empty($identity)){
					$this->common->show_json('Please choose identity !',false);
				}
				if(!empty($password) || !empty($repassword) ){
					if ($password != $repassword)
						$this->common->show_json('The passwords entered are not the same. Please re-enter them',false );
				}else {
					$this->common->show_json("Password or repassword can't empay ",false );
				}
				
				$Users = new Users();
				
				$Users-> username = $username;
				$Users-> email = $email;
				$Users-> password = $password;
				$Users-> name = $name;
				$Users->created = time();
				
				if ($Users->save() == false) {
					foreach ($Users->getMessages() as $message) {
						$this->common->show_json('Error : '.$message,false);
					}
				}else{
					
					$userid = $Users->userid;
					$UserRole = new UserRole();
					
					$UserRole->role_id = $role_id;
					$UserRole->user_id = $userid;
					/*Insert data into UserRole*/
					if($UserRole->save() == false){
						foreach ($UserRole->getMessages() as $message){
							$this->common->show_json('Error : '.$message,false);
						}
					}
					$this->common->show_json('Add user successful');
				}
				$this->common->show_json('this is test data',false);
			}
			
			//Get roles lists
			$roleResult = $this->rbac->get_role();
			$roleLists = $identityLists = array();
			foreach($roleResult as $key => $val){
				$roleLists[$key]['id'] = $val->id;
				$roleLists[$key]['name'] = $val->name;
			}
			//Get user identity
			$identityResult = UserIdentity::find();
			foreach($identityResult as $k => $v){
				$identityLists[$k]['id'] = $v->id;
				$identityLists[$k]['name'] = $v->name;
			}
			$this->view->setVar("roleLists", $roleLists);
			$this->view->setVar("identityLists", $identityLists);
			
		} else {
			if ($request->isAjax() == true) {
				//The search condition
				$keyWord = $request->get('key');
				$keyWord = empty($keyWord) ? '' : $keyWord;
				$parameters = empty($keyWord) ? '' : "username like '%$keyWord%'";
				$Users = Users::find($parameters);
				if(count($Users) > 0 ){	
					$page = $this->commoncircle -> get_page($Users,$this -> currentPage ,'/sysmanage/member',$this -> limit);
					$page ->  pageSize = $this->limit;
					$pageSizeOption = '';
					
					foreach($this->pageSizeArr as $key => $val){
						$selected = $this->limit == $val ? 'selected="selected"' : '';
						$pageSizeOption .= '<option value="'.$val.'" '.$selected.' data="/sysmanage/member?page=1&pageSize='.$val.'" >'.$val.'</option>';
					}
					$page ->  pageSizeOption = $pageSizeOption;
				
					foreach($page->items as $key => $val){
						$val->role = $this->commoncircle->get_role_by_userid($val->userid);
						$val->company = 'company_'.mt_rand(111,999);
					}			
					$page -> key = $keyWord;
					$this->common->show_json($page);
				}else{
					$arr = array('key'=>$keyWord);
					$this->common->show_json((object)$arr,false);					
				}
			}
		}
	}
	
	/**
	 * Company manage
	 */
	public function companyAction($option = '', $id = 0){
		$allowArr = array( 'edit', 'del', 'add');
		$option = in_array($option, $allowArr) ? $option : '';
		$request = $this->request;
		if ($option == 'edit') {
				
		} elseif ($option == 'del') {
			if ($request->isAjax() == true) {
				
				$id = $request->getPost('id');
	
				if($id == ''){
					$this->common->show_json('Illegal request !');
				}
				
				//Delete company data
				foreach(Company::find("id='$id'") as $company){
					if($company->delete() == false){
						foreach($company->getMessages() as $message){
							$this->common->show_json('Error '.$message,false);
						}
					}
				}
				//Delete company and relagional relation
				foreach(RegionalCompany::find("company_id='$id'") as $regionalcompany){
					if($regionalcompany->delete() == false){
						foreach($regionalcompany->getMessages() as $message ){
							$this->common->show_json('Error : '.$message,false);
						}
					}
				}
				$this->common->show_json('Delete company successful!');
				
			}	
		} elseif ($option == 'add') {
				
		} else {
			/*The search condition*/
			
			$key = $request->get('key');
			$key = empty($key) ? '' : $key;
			$regional = $request->get('regional');
			$regional = ($regional!= '') ? $regional : '';
			$searchCondition = "";
			if(!empty($key)){
				$searchCondition .= "WHERE Company.name like '%$key%'";
			}
			if($regional != ''){
				$joinStr = empty($searchCondition) ? ' WHERE ' : ' and ';
				$searchCondition .= $joinStr."RegionalCompany.regional_id=$regional";
			}
			
			$phql = "SELECT Company.id id ,Company.name companyname,Regional.name regionalname,Company.phone phone,Company.createtime createtime, Company.disid num FROM Company LEFT JOIN RegionalCompany ON Company.id=RegionalCompany.company_id LEFT JOIN Regional ON Regional.id=RegionalCompany.regional_id $searchCondition";
			$Company = $this->modelsManager->executeQuery ( $phql );
			
			$page = $this->commoncircle -> get_page($Company,$this -> currentPage ,'/sysmanage/company',$this -> limit);
			$page ->  pageSize = $this->limit;
			//Regional lists
			$regionalResult = Regional::find();
			$regionalOption = '<option value="0">全部</option>';
			$regionalStart = '';
			foreach($regionalResult as $k1 => $v1){
				if($regional!=0 && $regional==$v1->id){
					$regionalStart = '<option value="'.$v1->id.'" checked="checked" >'.$v1->name.'</option>';
				}else{
					$regionalOption .= '<option value="'.$v1->id.'" >'.$v1->name.'</option>';
				}
			}
			$page -> regionalOption = $regionalStart.$regionalOption;
			$page -> key = $key;
			$page -> regional = $regional;
			
			if(count($Company)>0){
				foreach($page->items as $key => $val){
					$val->formartTime = (date('Y-m-d',$val->createtime));
				}
				$this->common->show_json($page);
			}else{
				$arr = array('key'=>$key,'regional'=>$regional,'regionalOption'=>$regionalOption);
				$this->common->show_json((object)$arr,false);
			}
		}
	}
	
	/**
	 * Customer manage
	 * @param string $option
	 * @param number $id
	 */
	public function customerAction ($option = '', $id = 0) 
	{
		$allowArr = array( 'edit', 'del', 'add');
		$option = in_array($option, $allowArr) ? $option : '';
		
		if ($option == 'edit') {
				
		} elseif ($option == 'del') {
				
		} elseif ($option == 'add') {
				
		} else {
			
			$parameters = '';
			$Company = Customer::find($parameters);
				
			$page = $this->commoncircle -> get_page($Company,$this -> currentPage ,'/sysmanage/customer',$this -> limit);
			foreach($page->items as $key => $val){
				$val->area = 'area'.mt_rand(111,999);
				$val->num =  mt_rand(111, 999);
			}
			$this->common->show_json($page);
		}
	}
	/**
	 * Circle opration
	 */
	public function circleAction($option = '', $id = 0)
	{
		$allowArr = array( 'update', 'del', 'add','detail');
		$option = in_array($option, $allowArr) ? $option : '';
		$request = $this->request;
		
		
		if ($option == 'update') {
			if ($request->isAjax() == true) {
				$id = $request->getPost('circleid');
				$suggest = $request->getPost('suggest');
				$circleDetail = Circle::findFirst("circleid='$id'");
				$Circle = new Circle();
				$circleModel = $circleDetail;
				
				$circleModel-> status = '1';
				$circleModel-> review_suggest = $suggest;
				if ($circleModel->update() == false) {
					foreach ($circleModel->getMessages() as $message) {
						$this->common->show_json('Error : '.$message, false);
					}
				}
				$this->common->show_json('Successful');
			}else{
				$id = $request->get('id');
				if( !$id ){
					echo '<p>非法请求</p>';exit;
				}
				$circleDetail = Circle::findFirst("circleid='$id'");
				$member0 = $member1 = $member2 = $member3 = '';
				if( count ( $circleDetail ) > 0 ){
					$sql = "SELECT Users.username username , CircleMember.type type FROM CircleMember LEFT JOIN Users ON CircleMember.member_id = Users.userid WHERE CircleMember.circle_id='$id'";
					$memberList = $this->modelsManager->executeQuery ( $sql );
					foreach($memberList as $val){
					if($val->type == 0 )
						$member0 .= $val->username.'  ';
						if($val->type == 1 )
						$member1 .= $val->username.'  ';
						if($val->type ==2 )
						$member2 .= $val->username.'  ';
						if($val->type == 3)
								$member3 .= $val->username.'  ';
					}
				
					$circleInfo = array();
					$circleInfo['circleid'] = $circleDetail->circleid;
					$circleInfo['circlename'] = $circleDetail->name;
					$circleInfo['des'] = 'DES';
					$circleInfo['logo'] = $circleDetail->logo;
					$circleInfo['member0'] =  $member0;
					$circleInfo['member1'] =  $member1;
					$circleInfo['member2'] =  $member2;
					$circleInfo['member3'] =  $member3;
				}
				$this->view->setVar("option", $option);
				$this->view->setVar("circleInfo", $circleInfo);
			}		
		} elseif ($option == 'del') {
			if ($request->isAjax() == true) {
				$id = $request->getPost('id');
			
				$this->common->show_json('Delete failt !',false);
			}		
		} elseif ($option == 'add') {
		
		} else if($option == 'detail'){
			$id = $request->get('id');
			if( !$id ){
				echo '<p>非法请求</p>';exit;
			}
			
			$circleDetail = Circle::findFirst("circleid='$id'");
			$member0 = $member1 = $member2 = $member3 = '';
			if( count ( $circleDetail ) > 0 ){
				$sql = "SELECT Users.username username , CircleMember.type type FROM CircleMember LEFT JOIN Users ON CircleMember.member_id = Users.userid WHERE CircleMember.circle_id='$id'";	
				$memberList = $this->modelsManager->executeQuery ( $sql );
				foreach($memberList as $val){
					if($val->type == 0 )
						$member0 .= $val->username.'  ';
					if($val->type == 1 )
						$member1 .= $val->username.'  ';
					if($val->type ==2 )
						$member2 .= $val->username.'  ';
					if($val->type == 3)
						$member3 .= $val->username.'  ';
				}

				$circleInfo = array();
				$circleInfo['circlename'] = $circleDetail->name;
				$circleInfo['des'] = 'DES';
				$circleInfo['logo'] = $circleDetail->logo;
				$circleInfo['member0'] =  $member0;
				$circleInfo['member1'] =  $member1;
				$circleInfo['member2'] =  $member2;
				$circleInfo['member3'] =  $member3;
			}
			$this->view->setVar("option", $option);
			$this->view->setVar("circleInfo", $circleInfo);
		} else {
			$searchCondition = "";
			$regional = '';
			$keyWord = $request->get('key');
			$keyWord = empty($keyWord) ? '' : $keyWord;
			
			if(!empty($keyWord)){
				$searchCondition .= "WHERE Circle.name like '%$keyWord%'";
			}
			
			if($regional != ''){
				$joinStr = empty($searchCondition) ? ' WHERE ' : ' and ';
				$searchCondition .= $joinStr."RegionalCompany.regional_id=$regional";
			}
			
			$phql = "SELECT Circle.circleid id, Circle.name circlename, Company.name companyname, Circle.created created, Circle.status status ,Users.username username FROM Circle LEFT JOIN Users ON Users.userid=Circle.userid LEFT JOIN Company ON Circle.company_id=Company.id $searchCondition ";				
			$Circle = $this->modelsManager->executeQuery ( $phql );
			
			if(count($Circle) > 0 ){
				$page = $this->commoncircle -> get_page($Circle,$this -> currentPage ,'/sysmanage/circle',$this -> limit);
				foreach($page->items as $key => $val){
					$val->formatTime = date('Y-m-d',$val->created);
				}
				$page ->  pageSize = $this->limit;
				$page -> key = $keyWord;
				$this->common->show_json($page);	
			} else {
				$arr = array('key'=>$keyWord);
				$this->common->show_json((object)$arr,false);				
			}
		}
	}
	/**
	 * System setting
	 */
	public function settingAction($option = '', $id = 0)
	{
		$this->common->show_json('System setting');
	}
	
	/**
	 * System logs
	 */
	public function logAction($option = '', $id = 0)
	{
		$this->common->show_json('System logs');
	}
	
	public function addAction($option = '', $id = 0 ){
		
	}
	
	/*Circle  manange*/
	public function cindexAction(){
	}






}
