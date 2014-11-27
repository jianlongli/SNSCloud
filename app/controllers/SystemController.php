<?php

use Phalcon\Tag as Tag;

class SystemController extends ControllerBase
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

		$logList = Logs::find (' 1=1 order by createtime desc limit 10');
		$this->view->setVar('logList', $logList);

		$sql = "SELECT Circle.name name,Circle.circleid circleid FROM Circle RIGHT JOIN CircleMember ON Circle.circleid=CircleMember.circle_id WHERE CircleMember.member_id='$this->userid'";
                $circleList = $this->modelsManager->executeQuery ( $sql );

		$this->view->setVar('roleids',$authInfo['roleids']);
                $this->view->setVar('circleList',$circleList);
			
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
	
	public function personalAction($option = ''){
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
		}
		
		$userDetail = Users::findFirst("userid='$this->userid'");
		$this->view->setVar("userDetail", $userDetail);
	}
	
	public function inviteAction($option = '')
	{
		$allowArr = array( 'update', 'del', 'add');
		$option = in_array($option, $allowArr) ? $option : '';
		
		$request = $this->request;
		if($option == 'update'){
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
				$this->common->show_json(array('status'=>$status, 'id'=>$id));
			}else{
				$this->common->show_json('Illgal request',false);
			}			
		}else{
			/*The search condition*/
			$keyWord = $request->get('key');
			$keyWord = empty($keyWord) ? '' : $keyWord;
			$searchCondition = "";
			if(!empty($keyWord)){
				$searchCondition .= "AND Circle.name like '%$keyWord%'";
			}
			$phql = "SELECT CircleMember.Id id ,Circle.circleid circleid, CircleMember.Id id , Circle.name circlename,Users.username username,CircleMember.time time, CircleMember.status status FROM CircleMember LEFT JOIN Circle ON Circle.circleid=CircleMember.circle_id LEFT JOIN Users ON Users.userid=Circle.userid WHERE CircleMember.member_id='$this->userid' $searchCondition";
			$Invite = $this->modelsManager->executeQuery ( $phql );
			$page = $this->commoncircle -> get_page($Invite,$this -> currentPage ,'/system/invite',$this -> limit);
			$page ->  pageSize = $this->limit;
			$page -> key = $keyWord;
			$this->view->setVar("page", $page);
		}
	}
	
	
	public function memberAction($option  = ''){
		//The search condition
		$request = $this->request;
		
		$this->view->setVar('option' , $option);
		if ($option == 'edit') {

			//Process edit
			if ($request->isAjax() == true) {
			      	
				$passwordFlag = false;

                $userid = $request->getPost('userid');	
                $password = $request->getPost('password');
                $repassword = $request->getPost('repassword');
                $email = $request->getPost('email');
                $role_id = $request->getPost('role_id');
                $sex = $request->getPost('sex');
                $name = $request->getPost('name');
                $cityid = $request->getPost('company');
				
				if(empty($userid)){
                     $this->common->show_json('illgle request',false);
				}

                if(empty($role_id)){
                    $this->common->show_json('Please choose role !',false);
                }

				
                if(!empty($password) || !empty($repassword) ){
                	if ($password != $repassword)
                    	$this->common->show_json('The passwords entered are not the same. Please re-enter them',false );
				    $passwordFlag = true;	
                }
				
				$userDetail = Users::findFirst("userid='$userid'");

				if ($userDetail != false) {
					foreach ($userDetail->getUserRole() as $userRole) {
						$role_id_old = $userRole->getRole()->id;
					}
				}
				
				$UserModel = new Users();
				$UserModel = $userDetail;

				$UserModel->email = isset($email) ? $email : '';
				$UserModel->sex = $sex;
				$UserModel->name = $name;


				if($passwordFlag)
					$UserModel->password = $password;

				if ($UserModel->update() == false) {
					foreach ($UserModel->getMessages() as $message) {
						$this->common->show_json($message, false);
					}
				}
				
				/*Update user role*/
				if($role_id_old != $role_id){
					$this->update_user_role($userid,$role_id);
				}

				$this->common->show_json('Successful');
				
			}
			
			//Show user information for edit
			$userid = $request->get('id');
		    $userDetail = Users::findFirst("userid='$userid'");
            if ($userDetail != false) {
            	foreach ($userDetail->getUserRole() as $userRole) {
                	$userDetail->roleid = $userRole->getRole()->id;
                }
            }else{
				exit;
			}	
			
            //Get roles lists
            $roleResult = $this->rbac->get_role();
			$roleStr = '';
            foreach($roleResult as $key => $val){
				$isChecked = $userDetail->roleid == $val->id ? "checked='checked'" : '';
				$roleStr .='<input type="radio" name="role_id" id="role_id" value="'.$val->id.'"'.$isChecked.'/>'.$val->name;
            }
			$userDetail->userrole = $roleStr;
			$this->view->setVar("userDetail", $userDetail);	

		} elseif ($option == 'del') {
			if ($request->isAjax() == true) {
		
				$ids = $request->getPost('id');
		
				if($ids == ''){
					$password = $request->getPost('password');
                                        $repassword = $request->getPost('repassword');
                                        $email = $request->getPost('email');
                                        $phone = $request->getPost('phone');
                                        $birthday = $request->getPost('birthday');
                                        $sex = $request->getPost('sex');
                                        $provinceid = $request->getPost('provinceid');
                                        $cityid = $request->getPost('cityid');
                                        $county = $request->getPost('county');

					$this->common->show_json('Illegal request !',false);
				}
		
				if( strrpos($ids , ',') !== false){
					$ids = substr($ids,0,strlen($ids)-1);
				}
		
				//Delete user and role relation
				foreach(UserRole::find("user_id in('$ids')") as $userrole){
					if($userrole->delete() == false){
						foreach($userrole->getMessages() as $message ){
							$this->common->show_json('Error : '.$message,false);
						}
					}
				}
				
				//Delete users data
				foreach(Users::find("userid in($ids)") as $user){
					if($user->delete() == false){
						foreach($user->getMessages() as $message){
							$this->common->show_json('Error '.$message,false);
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
			
			/*Show user infomation */
				
			//Get roles lists
			$roleResult = $this->rbac->get_role();
			$roleLists = $identityLists = array();
			foreach($roleResult as $key => $val){
				$roleLists[$key]['id'] = $val->id;
				$roleLists[$key]['name'] = $val->name;
			}
			//Get user identity
			/*
			$identityResult = UserIdentity::find();
			foreach($identityResult as $k => $v){
				$identityLists[$k]['id'] = $v->id;
				$identityLists[$k]['name'] = $v->name;
			}
			*/
			$this->view->setVar("roleLists", $roleLists);
			$this->view->setVar("identityLists", $identityLists);
				
		} else {
			$keyWord = $request->get('key');
			$keyWord = empty($keyWord) ? '' : $keyWord;
			$parameters = empty($keyWord) ? '' : "username like '%$keyWord%'";
			$Users = Users::find($parameters);
			
			$page = $this->commoncircle -> get_page($Users,$this -> currentPage ,'/system/member',$this -> limit);
			$page ->  pageSize = $this->limit;
			$pageSizeOption = '';
				
			foreach($this->pageSizeArr as $key => $val){
				$selected = $this->limit == $val ? 'selected="selected"' : '';
				$pageSizeOption .= '<option value="'.$val.'" '.$selected.' data="/system/member?page=1&pageSize='.$val.'" >'.$val.'</option>';
			}
			$page ->  pageSizeOption = $pageSizeOption;
		
			foreach($page->items as $key => $val){
				$val->role = $this->commoncircle->get_role_by_userid($val->userid);
				$val->company = 'company_'.mt_rand(111,999);
			}
			
			$page -> key = $keyWord;
			$this->view->setVar("page", $page);
		}
	}
	
	public function companyAction($option = ''){
		
		$request = $this->request;
		$this->view->setVar('option' , $option);
		
		if ($option == 'edit') {
			if ($request->isAjax() == true) {
				
				$id = $request->getPost('id');
				$name = $request->getPost('name');
				$phone = $request->getPost('phone');
				
				$companyDetail = Company::findFirst("id='$id'");
				$CompanyModel = new Company();
				$CompanyModel = $companyDetail;
				
				$CompanyModel->name = $name;
				$CompanyModel->phone = $phone;
	
				
				if ($CompanyModel->update() == false) {
					foreach ($CompanyModel->getMessages() as $message) {
						$this->common->show_json($message, false);
					}
				}
				$this->common->show_json('Update success!');
			}
			
			$id = $request->get('id');
			$companyDetail = Company::findFirst("id='$id'");
			$this->view->setVar("companyDetail", $companyDetail);
			
		} elseif ($option == 'del') {
			if ($request->isAjax() == true) {
		
				$id = $request->getPost('id');
		
				if($id == ''){
					$this->common->show_json('Illegal request !',false);
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
			
			if ($request->isAjax() == true) {
				$name = $request->getPost('name');
				$phone = $request->getPost('phone');
				$createtime = time();
				if(empty($name))
					$this->common->show_json('name is empty !',false);
				if(empty($phone))
					$this->common->show_json('phone is empay',false);
				
				$Company = new Company();
				$Company-> name = $name;
				$Company-> phone = $phone;
				$Company-> disid = 0;
				$Company-> createtime = $createtime;
				
				if ($Company->save() == false) {
					foreach ($Company->getMessages() as $message) {
						$this->common->show_json('Error : '.$message,false);
					}
				}
				$this->common->show_json('Add success');
			}
			
		} else {
			$keyWork = $request->get('key');
			$keyWork = empty($keyWork) ? '' : $keyWork;
			$regional = $request->get('regional');
			$regional = ($regional!= '') ? $regional : '';
			$searchCondition = "";
			if(!empty($keyWork)){
				$searchCondition .= "WHERE Company.name like '%$keyWork%'";
			}
			if($regional != ''){
				$joinStr = empty($searchCondition) ? ' WHERE ' : ' and ';
				$searchCondition .= $joinStr."RegionalCompany.regional_id=$regional";
			}
				
			$phql = "SELECT Company.id id ,Company.name companyname,Regional.name regionalname,Company.phone phone,Company.createtime createtime, Company.disid num FROM Company LEFT JOIN RegionalCompany ON Company.id=RegionalCompany.company_id LEFT JOIN Regional ON Regional.id=RegionalCompany.regional_id $searchCondition";
			$Company = $this->modelsManager->executeQuery ( $phql );
				
			$page = $this->commoncircle -> get_page($Company,$this -> currentPage ,'/system/company',$this -> limit);
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
			$page -> key = $keyWork;
			$page -> regional = $regional;
			$this->view->setVar("page", $page);
		}
				
		
	}
	
	public function circleAction($option = ''){
		
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
				
			$page = $this->commoncircle -> get_page($Circle,$this -> currentPage ,'/system/circle',$this -> limit);
			$page ->  pageSize = $this->limit;
			$page -> key = $keyWord;
			$this->view->setVar("page", $page);
		}
		
	}
	public function settingAction(){
	}
	
	public function logAction(){
		
		
	}
	/**
	 * Personal information
	 * @param string $option
	 * @param number $id
	 */
	
	
	public function exportAction(){
		
		header('Content-Type: application/vnd.ms-excel'); //设置文件类型   也可以将 vnd.ms-excel' 改成xml（导出xml文件）
		header('Content-Disposition: attachment;filename="用户.xls"'); //设置导出的excel的名字
		
		$id=$this->request->get('id');
		$Users = Users::find();
		$list='
		<table>
		<tr>
		<td>用户id</td>
		<td>昵称</td>
		<td>密码</td>
		<td>邮箱</td>
		<td>姓名</td>
		<td>注册时间</td>
		</tr>';
		foreach ($Users as $robot){
			$list.=' <tr>
                   <td>'.$robot->userid.'</td>
                   <td>'.$robot->username.'</td>
                   <td>'.$robot->password.'</td>
                   <td>'.$robot->email.'</td>
                   <td>'.$robot->name.'</td>
                   <td>'.date('Y-m-d',$robot->created).'</td>
              </tr>';
		}
		$list.="</table>";
		echo $list;exit;
	}
	
	
	public function addAction($option = '', $id = 0 ){
		
	}
	
	/*Circle  manange*/
	public function cindexAction(){
	}

	public function update_user_role($userid, $roleid){
		$UserRole = UserRole::findFirst("user_id='$userid'");
		$UserRoleModel = new UserRole();
		$UserRoleModel = $UserRole;
		
		$UserRoleModel->role_id = $roleid;
		
		if ($UserRoleModel->update() == false) {
			foreach ($UserRoleModel->getMessages() as $message) {
				return 'Error:'.$message;
			}
		}
		return true;
	}	
}
