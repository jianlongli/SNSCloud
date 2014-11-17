<?php
use Phalcon\Tag as Tag;

/**
 * 讨论控制器
 * @author Wanggh
 * 2014/11/15
 */
class TopicController extends ControllerBase {
	public function initialize() {
		$config = new Phalcon\Config\Adapter\Ini(__DIR__.'/../config/config.ini');
		$this->session->set('object_name', $config->object->object_name);

		parent::initialize();
		if (!$this->session->get('auth')) {
			return $this->forward('session/index');
		}
	}

	public function indexAction( $circleId ) {
		Tag::setTitle($this->session->get('object_name').' | 发起讨论');
		$circleId = is_numeric( $circleId ) ? $circleId : 0;
		if ($circleId) {
			$delId = $this->request->get('delid');
			$delId = $delId ? $delId : 0;
			if ($delId) {
				$delInfo = Topic::findfirst ( 'topicid=' . $delId );
				foreach (Topicreply::find ( 'topicid=' . $delId) as $value) {
					$value->delete();
				}
				$delInfo->delete();
			}
			$pageSize = 10;
			$pageId = $this->request->get('page');
			$pageId = isset( $pageId ) ? $pageId : 1;
			$circleInfo = Circle::findFirst (' circleid=' . $circleId);
			$this->view->setVar('circleInfo', $circleInfo ? $circleInfo : false);
			
			$list = Topic::find( ' circleId=' . $circleId . ' and status=0 order by topicid desc ' );
			$paginator = new Phalcon\Paginator\Adapter\Model(array(
				"data" => $list,
				"limit" => $pageSize,           
				"page" => $pageId   
			));
			$page = $paginator->getPaginate();
			foreach ($page->items as $key=>$value) {
				$topicId = $value->topicid;
				$replyInfo = Topicreply::findfirst (' topicid=' . $topicId . ' and status=0 order by topicid desc ');
				if ($replyInfo) {
					$page->items [$key]->lastReplyTime = date('Y.m.d', $replyInfo->created);
					$userDetail = Users::findFirst(" userid='" . $replyInfo->userid  . "'");
					$page->items [$key]->lastReplyUserName = $userDetail->username;
				}
			}
			$this->view->setVar('page', $page ? $page : false);
		}
	}
	
	public function addtopicAction () {
		$circleId = isset( $_POST ['circleId'] ) ? $_POST ['circleId'] : 0;
		$topicName = $_POST ['topicName'];
		$topicDesc = $_POST ['topicDesc'];
		$return = array();
		if ($circleId && $topicName) {
			$userInfo = $this->session->get('auth');
			$topic = new Topic();
			$topic->userid = $userInfo ['userid'];
			$topic->title = $topicName;
			$topic->description = $topicDesc;
			$topic->created = time();
			$topic->status = 0;
			$topic->circleId = $circleId;
			if ($topic->save()) {
				$return ['topicName'] = $topicName;
				$return ['created'] = date('Y.m.d', time());
			}
		}
		$this->common->show_json($return, true);
	}
}