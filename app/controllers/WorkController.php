<?php

use Phalcon\Tag as Tag;

class WorkController extends ControllerBase
{
	var $pageSize = 100;//分页条数
	public function initialize()
	{
		$config = new Phalcon\Config\Adapter\Ini(__DIR__.'/../config/config.ini');
		$this->session->set('object_name', $config->object->object_name);

		parent::initialize();
	}

	public function indexAction()
	{
		if (!$this->session->get('auth')) {
			return $this->forward('session/index');
		}
		$this->view->setTemplateAfter('topbar');	
		Tag::setTitle($this->session->get('object_name').' | Sysmanage');
	}
	
	public function assignAction(){
		$type=$this->request->get('type');
		$circleId = $this->request->get('circleid');
		$user = $this->session->get('auth');
		$this->view->setVar( 'circleId', $circleId);
		if($type=="submit"){
			$title = $this->request->get('title');
			$description = $this->request->get('description');
			$created = $this->request->get('created');
			$endtime = $this->request->get('endtime');
			$receiveid = $this->request->get('receiveid');
			$workid = $this->request->get('workid');
			
			$work = new Work();
			if(!empty($workid)){
				$work->workid = $workid;
			}
			$work->userid = $user['userid'];
			$work->circleid = $circleId;
            $work->title = $title;
			$work->description = $description;
			$work->created = time();
			$work->starttime = strtotime($created);
			$work->endtime = strtotime($endtime);
			if($work->save() == false){
				foreach($work->getMessages() as $message){
					$this->common->show_json($message,false);
				}
			}else{
				
				if($receiveid=="all"){
					$circleUser= CircleMember::find ( 'circle_id=' . $circleId.' and status=0');
					foreach($circleUser as $val){
						$WorkReceive_data = WorkCommit::findFirst ( 'workid=' . $work->workid.' and userid='.$val->member_id);
						if(empty($WorkReceive_data->commitid)||$WorkReceive_data->userid!=$val->member_id){
							$WorkCommit = new WorkCommit();
							$WorkCommit->workid= $work->workid;
							$WorkCommit->userid= $val->member_id;
							// $WorkCommit->iscommit= 0;
							$WorkCommit->save();
						}
					}
				}else{
					$receiveids=explode(",",$receiveid);
					foreach($receiveids as $val){
						$WorkReceive_data = WorkCommit::findFirst ( 'workid='.$work->workid.' and userid='.$val);
						if(empty($WorkReceive_data->commitid)){
							$WorkCommit = new WorkCommit();
							$WorkCommit->workid= $work->workid;
							$WorkCommit->userid= $val;
							// $WorkCommit->iscommit= 0;
							$WorkCommit->save();
						}
					}
					$robot_commmit = WorkCommit::find("workid=".$work->workid." and userid not in (".$receiveid.")");
					$robot_commmit->delete();
				}
				$ccloudid=$this->file->mk_dir_work($work->workid,$work->created,$circleId);
				$work->workid = $work->workid;
				$work->dirid= $ccloudid;
				$work->save();
				 $this->common->show_json("ok");
			}
		
		}elseif($type=="ajax_list"){
			$page = $this->request->get('page');//取页数
			//查询作业列表
			$work_data= Work::find ( 'circleid='.$circleId.' and userid='.$user['userid'].' order by created DESC');
			$work_data=$this->commoncircle->get_page_ajax($work_data,$page,'',$this->pageSize,'5','3',"worklist");
			$datahtml="";
			foreach ($work_data->items as $key => $value) {
				//$WorkReceive_data = WorkCommit::find( 'workid=' . $value->workid);
				 $sql = "SELECT WorkCommit.userid as userid,Users.name as username FROM WorkCommit LEFT JOIN Users ON WorkCommit.userid=Users.userid  WHERE WorkCommit.workid=".$value->workid;
				$WorkReceive_data =  $this->modelsManager->executeQuery ( $sql );
				$receiveid="";
				foreach($WorkReceive_data as $val){
					$receiveid['0'][]=$val->username;
					$receiveid['1'][]=$val->userid;
				}
				$receiveid_str[0] = implode(',',$receiveid['0']);
				$receiveid_str[1]=implode(',',$receiveid['1']);
				$value->created=date("Y-m-d H:i:s",$value->created); 
				$value->endtime=date("Y-m-d H:i:s",$value->endtime); 
				$datahtml=$datahtml."<tr><td style='text-align:left;'><a href='#' style=' color:#00F;'>".$value->title."</a></td><td>".$value->created."</td><td><input type='button' value='编辑'  class='deletBut1' onclick=\"redact('".$value->workid."');\"/>　<input type='button' value='删除'  class='deletBut1' onclick=\"del('".$value->workid."','".$page."');\"/></td></tr><input id='".$value->workid."htitle' type='hidden' value='".$value->title."' /><input id='".$value->workid."hdescription' type='hidden' value='".$value->description."' /><input id='".$value->workid."hcreated' type='hidden' value='".$value->created."' /><input id='".$value->workid."hendtime' type='hidden' value='".$value->endtime."' /><input id='".$value->workid."hreceiveid' type='hidden' value='".$receiveid_str[0]."' /><input id='".$value->workid."hhdreceiveid' type='hidden' value='".$receiveid_str[1]."' /><input id='".$value->workid."hcircleid' type='hidden' value='".$value->circleid."' />";
			}
			$datahtmls="<tr class='tabletr'><td>作业名称</td><td width='200'>发布日期</td>'<td width='150'>操作</td></tr>".$datahtml;
			//."<tr class='tabletr1'><td colspan=3>".$work_data->lists."</td></tr>";

				$this->common->show_json($datahtmls);die;
		}elseif($type=="del"){
			$workid = $this->request->get('workid');

			$robot = Work::findFirst("workid=".$workid);
			if ($robot != false) {
			    if ($robot->delete() == false) {
			        $this->common->show_json("no");
			    } else {
					$robot_commmit = WorkCommit::find("workid=".$workid);
					$robot_commmit->delete();
			       $this->common->show_json("ok");
			    }
			}


			$this->common->show_json("ok");
		}else{
			$circname = Circle::findFirst ( 'circleid=' . $circleId );
			$this->view->setVar( 'circname', $circname->name);
			
			
		}
	
		
	}
	
	public function receiveAction(){
			$circleId = $this->request->get('circleid');
			$this->view->setVar( 'circleId', $circleId);
			$type=$this->request->get('type');
			if($type=='seach'){
				$seach_text = $this->request->get('seach_text');
				$phql = "SELECT CircleMember.member_id member_id,Users.username username,CircleMember.time time, CircleMember.status status FROM CircleMember LEFT JOIN Users ON CircleMember.member_id=Users.userid WHERE CircleMember.circle_id=".$circleId." and Users.username like '%".$seach_text."%'";
				$member_data = $this->modelsManager->executeQuery ( $phql );
				$title_html="<tr class='trd'><td width='42'><input type='checkbox' id='allcheck' onclick='allchak();'/></td><td width='210' >姓名</td><td>学校</td></tr>";
				foreach($member_data as $val){
					$html_data=$html_data."<tr><td><input type='checkbox' name='putname' value='".$val->member_id."'/><input name='checkname".$val->member_id."' id='checkname".$val->member_id."' type='hidden' value='". $val->username."' /></td><td>".$val->username."</td><td>石景山二小1</td></tr>";
				}
				$html_datas=$title_html.$html_data;
				$this->common->show_json($html_datas);
			}else{
				$phql = "SELECT CircleMember.member_id member_id,Users.username username,CircleMember.time time, CircleMember.status status FROM CircleMember LEFT JOIN Users ON CircleMember.member_id=Users.userid WHERE CircleMember.circle_id=".$circleId;
				$member_data = $this->modelsManager->executeQuery ( $phql );
				
				$this->view->setVar( 'member_data', $member_data);
			}
			
			
	}

	public function myworkAction(){
		$user = $this->session->get('auth');
		$circleId = $this->request->get('circleid');
		$searchCondition = empty($circleId) ? '' : ' AND Circle.circleid='.$circleId;
		//$work_data= Work::find ('userid='.$user['userid'] );
		 $sqls = "SELECT Work.title name,Work.workid workid,Work.starttime starttime,Work.endtime endtime,WorkCommit.ccloudid iscommit,WorkCommit.commitid commitid,Circle.name cirlename ,Users.name as username FROM WorkCommit LEFT JOIN Work ON WorkCommit.workid=Work.workid LEFT JOIN Circle ON Work.circleid =Circle.circleid LEFT JOIN Users ON WorkCommit.userid=Users.userid WHERE WorkCommit.userid=".$user['userid'].$searchCondition;
		$mywork_data =  $this->modelsManager->executeQuery ( $sqls );
		//$mywork_data=$this->commoncircle->get_page($mywork_data,$page,'/work/mywork',$this->pageSize,'5','3');
		$this->view->setVar( 'mywork_data', $mywork_data);
	}
	//交作业
	public function addworkAction(){
		$workid = $this->request->get('workid');
		$type=$this->request->get('type');
		$user = $this->session->get('auth');
		if($type=="submit"){
			$work_data = Work::findFirst ( 'workid=' . $workid );
			$fileManage = CircleCloudfileManage::findFirst ( 'ccloudid=' . $work_data->dirid );
			foreach($_FILES as $key=>$val){
				if(!empty($val['name'])){
					$return_data=$this->file->circleupload($key,$fileManage->oldurl,$workid);
					$ccloudid[]=$return_data;
				}
			}
			$ccloudid=implode(',',$ccloudid);
			$commmit_data = WorkCommit::findFirst("workid=".$workid." and userid= ".$user['userid']);
			$WorkCommit = new WorkCommit();
			$WorkCommit->commitid= $commmit_data->commitid;
			$WorkCommit->ccloudid= $ccloudid;
			$WorkCommit->workid= $workid;
			$WorkCommit->userid= $user['userid'];
			$WorkCommit->save();
			echo "<script>parent.$('.hialertcalss').remove();parent.$('.alertcalss').remove();parent.$('#sbwork".$commmit_data->commitid."').html('".$user['name']."的作业');parent.$('#sbwork_is".$commmit_data->commitid."').html('已经提交')</script>";
			die;
		}else{
			$work = Work::findFirst ( 'workid=' . $workid );
			$this->view->setVar( 'work', $work);
			$this->view->setVar( 'type', $type);
		}
		
	}
	
	




}
