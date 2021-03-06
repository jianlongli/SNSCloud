<?php echo $this->tag->stylesheetLink('./static/style/skin/metro/app_explorer.css'); ?>
<?php echo $this->tag->stylesheetLink('./eduis/css/stylesp.css'); ?>
<?php echo $this->tag->stylesheetLink('./eduis/css/style.css'); ?>
<?php echo $this->tag->stylesheetLink('./eduis/css/circle.css'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/jquery.min.js'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/shipj.js'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/hover.js'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/_dev/src/explorer/circle.js'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/alertInfo.js'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/zz.js'); ?>

	<div class="init_loading"><div><img src="<?php echo @$controllerName=='session' ? '../' : './'; ?>static/images/loading_simple.gif"/></div></div>

	<div class="frame-main">
		<div class='frame-left'>
			<div class="GiLtop"><h2>我的圈子</h2></div>
			<!--代码开始-->
            <div id="wrapper-250">
                <ul class="accordion">
                    <li id="one" class="files"> <a class="active" href="/circle">全部圈子<span>130</span></a>
                        <ul class="sub-menu" style="display: block;">
			    <?php foreach($circleList as $val){?>
			    <li><a href="/circle/info/<?php echo $val->circleid;?>"><?php echo $val->name;?></a></li>
			    <?php }?>

			    <!--
                            <li><a id="picture" href="#picture"><em></em>图片</a></li>
                            <li><a id="video" href="#video"><em></em>视频</a></li>
                            <li><a id="music" href="#music"><em></em>音乐</a></li>
                            <li><a id="document" href="#document"><em></em>文档</a></li>
                            <li><a id="other" href="#other"><em></em>其他</a></li>
			    -->
                        </ul>
                    </li>
                    <li id="two" class="circle"> <a href="/index">我的G盘<span>261</span></a></li>
                    <li id="three" class="cloud"> <a href="#three">主题讨论<span>305</span></a></li>
                    <li id="four" class="share"> <a href="#four">外来文件<span>15</span></a></li>
                    <li id="five" class="trash"> <a href="#five">回收站<span></span></a></li>
                </ul>
            </div>
            <!--代码结束-->
		</div><!-- / frame-left end-->
		<!-- <div class='frame-resize'></div> -->
		
		<div class="GIRight1">
               <div id="rising_menu">
                <div id="navmenu">
                  <ul>
                    <li><span class="navmenu_on" id="risingmenu1" onmouseover="doClick_risingmenu(this);"><a href="#" >圈子通知</a></span></li>
                  </ul>
                </div>
                <div class="submenu">
                  <div class="none" id="sub" style="display: block; color: #40BBD0; height: 36px; width: 100%; min-width: 760px;" border="1" align="center" cellpadding="0" cellspacing="0">
                    <marquee scrollAmount=3 hspace="100" onmouseover="stop()" onmouseout="start()">
                        请各位老师在9月30日前提交<a href='#' style="color: #428bca;">【我的微课】
                        </a>作业！
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        请各位老师在10月12日前提交<a href='#' style="color: #428bca;">【十一活动】
                        </a>作业！
                    </marquee>
                  </div>
                </div>
                <!-- <div id="kakamenu"><a href="" title=""><img src="../../../eduis/images/pf_but.png" /></a></div> -->
              	
				<div class="top_right">
				<div id="kakamenu">
					<?php $authInfo = $this->session->get('auth');?>
					<?php if ($authInfo != '') { ?>
					<!-- ToDo:点击弹出菜单 -->
					<a href="#" id='topbar_user' data-toggle="dropdown"><?php echo $authInfo['username'];?>您好！欢迎您登陆教育既<i class="icon-user"></i><b class="caret"></b></a>
					<input type="hidden" value="<?php echo $authInfo['roleids'];?>" id='roleid'/> 
					<ul class="dropdown-menu menu-topbar_user fadein" role="menu" aria-labelledby="topbar_user" style="left:65px;">
						<li><a href="/system#personal">个人信息</a></li>
						<li><a href="/system#invite">圈子邀请(<?php echo $inviteCount;?>)</a></li>
						<?php if($authInfo['roleids'] == 1){ ?>
						<li><a href="/system#member">用户管理</a></li>
						<li><a href="/system#company">单位管理</a></li>
						<li><a href="/system#circle">圈子审批</a></li>
						<li><a href="/system#setting">系统设置</a></li>
						<li><a href="/system#log">系统日志</a></li>
						<?php } ?>
						<li><a href="/session/end">退出</a></li>
					</ul>		
					<?php } ?>
				</div>
				</div>
				<div style="clear:both"></div><!-- top_right End -->
              	
              </div>
		<div class='frame-right'>
			<div class="frame-right-main">
				<div class="tools">
					<div class="tools-custom-left pull-left">
						<a class="reviewCircle pull-right" href="javascript:;" id="create_circle_button">申请圈子</a>
					</div>
					<div class="tools-custom-right pull-right">
						<div class="search pull-right">
							<input type="text" class="pull-left" name="search" id="search_content"/>
							<span class="searchBtn" id="search_button"></span>
						</div>
					</div>
				</div><!-- end tools -->
				<div class='bodymain html5_drag_upload_box'>
					<div class="circleContiner">
						<div class="circleContiner-left pull-left">
							<div class="circleContiner-main">
								<ul id="circleList"></ul>
							</div>
						</div><!-- .circleContiner-left end -->

						<div class="circleContiner-right pull-right">
							<h3 id="workmanage" style="text-indent: 4.4em;"><div style="padding-top:10px; font-size:19px;"><?php echo $mywork_all_num; ?></div></h3>
						<?php if(!empty($worklist->workid)){?>
							<div class="circleWork" style="display:none;">
							<h4 style="margin-top:0px;">作业管理<span><a href="#" id='myzuoye' data-circleid="0">更多>></a><span></h4>
							
								<p><?php echo $worklist->name; ?></p>
								<ul>
									<li>新作业<span onclick=" $.alertUrl('/work/addwork/?workid=<?php echo $worklist->workid; ?>', '　交作业', 730,450);" >交作业</span></li>
									<li><?php echo date("Y-m-d",$worklist->created); ?></li>
									<li>生效日期:<?php echo date("Y-m-d",$worklist->starttime); ?></li>
									<li>失效日期:<?php echo date("Y-m-d",$worklist->endtime); ?></li>
								</ul>
							<?php }else{ ?>
								<div class="circleWork" style="display:none;">
							<h4 style="margin-top:0px;">作业管理<span><span></h4>
								<p>您没有需要完成的作业</p>
							<?php } ?>
							</div>
							<h4>圈子动态<span><a href="#">更多>></a><span></h4>
							<div class="dynamic">
								<ul>
									<?php foreach($logList as $value){
										echo '<li title="' . $value->description . '">' . mb_substr($value->description, 0, 10, 'utf-8' ) . '...</li>';
									}?>
								</ul>
							</div>
						</div><!-- .circleContiner-right end -->

					</div><!-- .fileContiner end-->
				</div><!-- html5拖拽上传list -->
			</div>
		</div><!-- / frame-right end-->
	</div><!-- / frame-main end-->
<script src="/circleinfo/js/lib/seajs/sea.js"></script>
<script src="./circlestatic/js/lib/artDialog/jquery-artDialog.js?skin=default" type="text/javascript"></script>
<script>

function place_circle_list (_data) {
        var _html = "";
        if (_data.code) {
                var _circle_data = _data.data.items;
                $.each(_circle_data, function(i,n){

			_html += '<li class="circleItem">';
				_html +='<a href="/circle/info/' + n.circleid + '"><img src="' + n.logoUrl + '" width="177" height="177" /></a>';
				_html +='<span>' + n.userName + '</span>';
				_html +='<h5><a href="/circle/info/' + n.circleid + '" >' + n.name + '</a></h5>';
				_html +='<p>成员：' + n.total_count + '　资源：' + n.fileCount + '　讨论：' + n.topicCount + ' 作业：' + n.workCount + '　通知：36</p>';
			_html +='</li>';

                });
		/*
                var _totalPage = _data.data.total_pages;
                if (_totalPage > 1) {
                        _html += '<div class="qGirleft5"><p>';
                        _html += '<span>共<span>' + _data.data.total_items + '</span>条数据</span>';
                        _html += '<input type="button" value="首页" data-page="' + _data.data.first + '"/>';
                        _html += '<input type="button" value="上一页" data-page="' + _data.data.before + '" />';
                        _html += '<input type="button" value="下一页" data-page="' + _data.data.next + '" />';
                        _html += '<input type="button" value="尾页" data-page="' + _totalPage + '"/>';
                        _html += '<span>当前<span>' + _data.data.current + '</span>页</span>';
                        _html += '<span>共<span>' + _totalPage + '</span>页</span>';
                        _html += '</p></div>';
                }
		*/
	}else{
		_html += _data.data;
	}
        $('#circleList').html(_html);
        $('.init_loading').fadeOut(450).addClass('pop_fadeout');
}
$(document).ready(function(){
        $('#search_button').live('click', function(){
                $('.init_loading').fadeIn(450).removeClass('pop_fadeout');
                $.circle._get_all_circle ( 1, place_circle_list, $('#search_content').val() );
        });
        $('input[data-page]').live('click', function(){
                var _pageId = $(this).attr('data-page');
                _pageId = _pageId ? parseInt (_pageId) : 1;
                $.circle._get_all_circle ( _pageId, place_circle_list );
        });
        $.circle._get_all_circle ( 1, place_circle_list );
        $('#btn1').live('click', function(){
                $('#demo').css('display') == 'none' ? $('#demo').slideDown() : $('#demo').slideUp();
        });

        $('#create_circle_button').click(function(){
                $.circle._create();
        });
	
	$("#workmanage").click(function(){
		$(".circleWork").toggle();
	});	
	
	$("body").click(function(){
		$(".menu-topbar_user").css('display') == 'none' ? '' : $(".menu-topbar_user").hide();
	});	
	$("#topbar_user").click(function(){
		$(".menu-topbar_user").css('display') == 'none' ? $(".menu-topbar_user").show() : $(".menu-topbar_user").hide();
		return false;
	});		
});
</script>
