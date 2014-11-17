<?php
class CommonCircle extends Phalcon\Mvc\User\Component {
	
	/**
	 * Get user role by uid
	 * @param $userid int
	 */
	public function get_role_by_userid($userid = 0) {
		if (empty ( $userid )) {
			return 'null';
		}
		
		$phql = "SELECT Role.name name FROM Users LEFT JOIN UserRole ON UserRole.user_id=Users.userid LEFT JOIN Role ON Role.id=UserRole.role_id WHERE Users.userid='$userid' LIMIT 1";
		$robots = $this->modelsManager->executeQuery ( $phql );
		
		$name = '';
		foreach ( $robots as $val ) {
			$name = $val->name;
		}
		return $name;
	}
	/**
	 * Get district
	 * $id = 0 : get all ; $id != 0 : get by id
	 */
	public function get_regional($id = 0) {
		$data = array ();
		
		if (empty ( $id )) {
			$regional = Regional::find ();
			foreach ( $regional as $key => $val ) {
				$data [$key] ['id'] = $val->id;
				$data [$key] ['name'] = $val->name;
			}
		} else {
			$regional = Regional::findFirst ( "id=$id" );
			return $regional->name;
		}
		return $data;
	}
	
	/**
	 * Get pages
	 * @param $source
	 * @param int $currentPage
	 * @param string $url
	 * @param int $pageSize
	 * @param int $page_len
	 * @param int $pageOffset
	 */
	public function get_page($source = array(),$currentPage = 1 ,$url = '',$pageSize = 10,$page_len = 3, $pageOffset = 1){
		
		if(count($source) > 0){
			$paginator = new Phalcon\Paginator\Adapter\Model(array(
				"data" => $source,    
				"limit" => $pageSize,       
				"page" => $currentPage 
			));
			$page = $paginator->getPaginate();
				
			/*Show page code*/
			$pageString = $pageCode = '';
			$init = 1;
			$max_p= $page->total_pages;
				
			if($page->total_pages > $page_len)
			{
				if($page->current <= $pageOffset){
					$max_p = $page_len;
				}else{
					if($page->current+$pageOffset >= $page->total_pages){
						$init = $page->total_pages-$page_len;
					}else{
						$init = $page->current-$pageOffset;
						$max_p = $page->current+$pageOffset;
					}
				}
			}
			for($i = $init; $i <= $max_p; $i++)
			{
				$currentClass = $i == $currentPage ? 'currentClass' : '';
				$pageCode .= '<span><input class= "syspage '.$currentClass.'" data="'.$url.'?page='.$i.'&pageSize='.$pageSize.'" type="button" value="'.$i.'"/><span>';
			}
			$page->lists = $pageCode;
		}else{
			$page = array();
		}
		return $page;
	}
	
        /**
         * get_page_ajax
         * @param $source
         * @param int $currentPage
         * @param string $url
         * @param int $pageSize
         * @param int $page_len
         * @param int $pageOffset
         * @param int $clickfunction
         */
        public function get_page_ajax($source = array(),$currentPage = 1 ,$url = '',$pageSize = 10,$page_len = 3, $pageOffset = 1,$clickfunction=""){

                if(count($source) > 0){
                        $paginator = new Phalcon\Paginator\Adapter\Model(array(
                                "data" => $source,
                                "limit" => $pageSize,
                                "page" => $currentPage
                        ));
                        $page = $paginator->getPaginate();

                        /*Show page code*/
                        $pageString = $pageCode = '';
                        $init = 1;
                        $max_p= $page->total_pages;

                        if($page->total_pages > $page_len)
                        {
                                if($page->current <= $pageOffset){
                                        $max_p = $page_len;
                                }else{
                                        if($page->current+$pageOffset >= $page->total_pages){
                                                $init = $page->total_pages-$page_len;
                                        }else{
                                                $init = $page->current-$pageOffset;
                                                $max_p = $page->current+$pageOffset;
                                        }
                                }
                        }
                        for($i = $init; $i <= $max_p; $i++)
                        {
                                if($clickfunction!=""){
                                        $pageCode .= '<span><input class= "syspage" data="'.$url.'?page='.$i.'&pageSize='.$pageSize.'" type="button" value="'.$i.'" onclick='.$clickfunction.'("'.$i.'"); /><span>';
                                }else{
                                        $pageCode .= '<span><input class= "syspage" data="'.$url.'?page='.$i.'&pageSize='.$pageSize.'" type="button" value="'.$i.'"/><span>';
                                }

                        }
                        $page->lists = $pageCode;
                }else{
                        $page = array();
                }
                return $page;
        }
	
}
