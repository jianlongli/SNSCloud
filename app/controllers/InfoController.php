<?php

use Phalcon\Tag as Tag;

class InfoController extends ControllerBase
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
			$page = $this->commoncircle -> get_page($memberlists,$this -> currentPage ,'/info/member',$this -> limit);
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
	public function infocAction(){
	
	}

}
