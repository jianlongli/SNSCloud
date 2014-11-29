<?php echo $this->tag->stylesheetLink('./static/style/skin/metro/app_explorer.css'); ?>
<?php echo $this->tag->stylesheetLink('./eduis/css/stylesp.css'); ?>
<?php echo $this->tag->stylesheetLink('./eduis/css/style.css'); ?>
<?php echo $this->tag->stylesheetLink('./eduis/css/circle.css'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/jquery.min.js'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/shipj.js'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/hover.js'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/_dev/src/explorer/circle.js'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/zz.js'); ?>

	<div class="init_loading"><div><img src="/circlestatic/images/loading_simple.gif"/></div></div>

	<div class="frame-main">
		<div class='frame-left'>
			<div class='GiLtop'><h2>我的圈子</h2></div>
			<!-- <ul id="folderList" class="ztree"></ul> -->
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
						<li><a href="/system#invite">圈子邀请(3)</a></li>
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
					<div class="tools-left">
						<div class="btn-group btn-group-sm">
					        <button id='upload' type="button" style='width: 92px; height: 29px; background: #e33658; border: 0px solid #e6e6e6; float: left;'>
					           <div style='width: 100%'>
					           <img style='margin-top: -3px;' src='../../../eduis/images/scw.png'>
					           <span style='font-size: 14px; font-weight: bold; color: #FFF; padding-left: 10px;'>上传</span></div>
					        </button>

					        <button id='newfolder' class="btn btn-default" type="button" style='width: 113px; height: 20px; border-radius: 0px;'>
					        	<img style='margin-top: -3px;' src='../../../eduis/images/xjw.png'>
					        	<span style='font-size: 14px; font-weight: bold; padding-left: 10px;'>新建文件夹</span>
					        </button>
					        <button id='newfile' class="btn btn-default" type="button" style='width: 96px; height: 20px; border-radius: 0px; margin-left: -1px;'>
					        	<i class="font-icon icon-file-alt"></i>
					        	<span style='font-size: 14px; font-weight: bold; padding-left: 10px;'>新建文件</span>
                            </button>
					        <div class="btn-group btn-group-sm">
						    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" style='width: 96px; height: 20px; border-radius: 0px; margin-left: -1px;'>
						      <i class="font-icon icon-tasks"></i>更多&nbsp;<span class="caret"></span>	      
						    </button>
						    <ul class="dropdown-menu pull-right drop-menu-action fadein">
						    	<li id="open"><a href='javascript:;'>
						    	<i class="font-icon icon-folder-open-alt"></i>打开</a></li>

							    <li id="copy"><a href='javascript:;'>
							    <i class="font-icon icon-copy"></i>复制</a></li>

							    <li id="rname"><a href='javascript:;'>
							    <i class="font-icon icon-pencil"></i>重命名</a></li>

							    <li id="cute"><a href='javascript:;'>
							    <i class="font-icon icon-cut"></i>剪切</a></li>
							    <li id="past"><a href='javascript:;'>
							    <i class="font-icon icon-paste"></i>粘贴</a></li>
							    <li id="remove"><a href='javascript:;'>
							    <i class="font-icon icon-trash"></i>删除</a></li>

							    <li class="divider"></li>
							    <li id="share"><a href='javascript:;'>
							    <li id="download"><a href='javascript:;'>
							    <i class="font-icon icon-download"></i>下载</a></li>
						    </ul>
						  </div>
						</div>
						<span class='msg'>载入中...</span>
                        </div>
                        <div style="clear:both"></div>
				</div><!-- end tools -->
				<div class='bodymain html5_drag_upload_box'>
					<div class="circleContiner">
						<div class="circleContiner-left pull-left">
							<div class="circleContiner-main">
								<ul class="fileContiner"></ul>
							</div>
						</div><!-- .circleContiner-left end -->

						<div class="circleContiner-right pull-right">
							<?php if($roleids == 1 || $iscirclemanager){?>
								<a href="#" class="btnF sendNotice">发布通知</a>
								<a href="#" id="zuoye" class="btnF work" data-id="<?php echo $circleId; ?>">布置作业</a>
								<a href="javascript:;" id="discuss_begin_button" data-id="<?php echo $circleId;?>" class="btnF discuss">发起讨论</a>
								<a class="btnF circlemanage"  href="/circlemanage?id=<?php echo $circleId;?>" id="circleManage">圈子管理</a>
							<?php }else{ ?>
								<a href="#" class="btnF sendNotice" style="background:url(/eduis/images/wdtz.png);">发布通知</a>
								<a class="btnF introcircle"  href="/info?id=<?php echo $circleId;?>">了解圈子</a>
								<a class="btnF workmanage"  id="myzuoye" data-circleid="<?php echo $circleId;?>" href="javascript:;" style="background:url(/eduis/images/jzy.png)";>作业管理</a>
							<?php } ?>

							<h4>圈子动态<span><a href="javascript:;">更多>></a><span></h4>
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
<script type="text/javascript">
	$('#discuss_begin_button').click(function(){
		var _circleId = $(this).attr('data-id');
		
		art.dialog.open ('/topic/index/' + _circleId, {
			id : 'topic_div',
			fixed : true,
			title : '发起讨论',
			lock : true,
			height : '650px',
			width : '860px',
			ok:function(){},
			okVal : '关闭讨论区'
		});
	});
		$(".sendNotice").live('click' , function() {
		art.dialog.open('/notice/index/?id=<?php echo $circleId;?>',{
			fixed : true,
			title : '发通知',
			lock : true,
			height : '660px',
			width : '1000px',
		})
		
		;
	});
    var LNG = {"config":{"type":"zh_CN","name":"\u7b80\u4f53\u4e2d\u6587","authoer":"warlee"},"login":"\u767b\u9646","guest_login":"\u6e38\u5ba2\u767b\u5f55","username":"\u7528\u6237\u540d","password":"\u5bc6\u7801","login_code":"\u9a8c\u8bc1\u7801","login_rember_password":"\u8bb0\u4f4f\u5bc6\u7801","us":"\u5343\u5e06\u7f51\u7edc\u5de5\u4f5c\u5ba4","login_not_null":"\u7528\u6237\u540d\u5bc6\u7801\u4e0d\u80fd\u4e3a\u7a7a!","code_error":"\u9a8c\u8bc1\u7801\u9519\u8bef","user_not_exists":"\u7528\u6237\u540d\u4e0d\u5b58\u5728!","password_error":"\u5bc6\u7801\u9519\u8bef!","password_not_null":"\u5bc6\u7801\u4e0d\u80fd\u4e3a\u7a7a!","old_password_error":"\u539f\u5bc6\u7801\u9519\u8bef!","permission":"\u6743\u9650!","permission_edit":"\u4fee\u6539\u6743\u9650","no_permission":"\u60a8\u6ca1\u6709\u6b64\u6743\u9650!","no_permission_ext":"\u60a8\u6ca1\u6709\u8be5\u7c7b\u578b\u6587\u4ef6\u6743\u9650","dialog_min":"\u6700\u5c0f\u5316","dialog_min_all":"\u6700\u5c0f\u5316\u6240\u6709","dialog_display_all":"\u663e\u793a\u6240\u6709\u7a97\u53e3","dialog_close_all":"\u5173\u95ed\u6240\u6709\u7a97\u53e3","title":"KODExplorer-\u8292\u679c\u4e91\u2022\u8d44\u6e90\u7ba1\u7406\u5668","title_name":"\u8292\u679c\u4e91\u2022\u8d44\u6e90\u7ba1\u7406\u5668","open":"\u6253\u5f00","others":"\u5176\u4ed6","open_with":"\u6253\u5f00\u65b9\u5f0f","close":"\u5173\u95ed","close_all":"\u5173\u95ed\u5168\u90e8","close_right":"\u5173\u95ed\u53f3\u4fa7\u6807\u7b7e","close_others":"\u5173\u95ed\u5176\u4ed6","loading":"\u64cd\u4f5c\u4e2d...","warning":"\u8b66\u544a","getting":"\u83b7\u53d6\u4e2d...","sending":"\u6570\u636e\u53d1\u9001\u4e2d...","data_error":"\u6570\u636e\u51fa\u9519\uff01","get_success":"\u83b7\u53d6\u6210\u529f!","save_success":"\u4fdd\u5b58\u6210\u529f!","success":"\u64cd\u4f5c\u6210\u529f","error":"\u64cd\u4f5c\u5931\u8d25","error_repeat":"'\u64cd\u4f5c\u5931\u8d25\uff0c\u8bf7\u6ce8\u610f\u540d\u79f0\u4e0d\u80fd\u91cd\u590d\uff01'","system_error":"\u7cfb\u7edf\u9519\u8bef","name":"\u540d\u79f0","type":"\u7c7b\u578b","contain":"\u5305\u542b","address":"\u4f4d\u7f6e","size":"\u5927\u5c0f","byte":"\u5b57\u8282","path":"\u8def\u5f84","action":"\u64cd\u4f5c","create_time":"\u521b\u5efa\u65f6\u95f4","modify_time":"\u4fee\u6539\u65f6\u95f4","last_time":"\u6700\u540e\u8bbf\u95ee","sort_type":"\u6392\u5e8f\u65b9\u5f0f","time_type":"Y\/m\/d H:i","time_type_info":"Y\u5e74m\u6708d\u65e5 H:i:s","public_path":"\u516c\u5171\u76ee\u5f55","file":"\u6587\u4ef6","folder":"\u6587\u4ef6\u5939","copy":"\u590d\u5236","past":"\u7c98\u8d34","clone":"\u521b\u5efa\u526f\u672c","cute":"\u526a\u5207","remove":"\u5220\u9664","info":"\u5c5e\u6027","list_type":"\u67e5\u770b","list_icon":"\u56fe\u6807\u6392\u5217","list_list":"\u5217\u8868\u6392\u5217","sort_up":"\u9012\u589e","sort_down":"\u9012\u51cf","order_type":"\u6392\u5e8f\u65b9\u5f0f","order_desc":"\u964d\u5e8f","order_asc":"\u5347\u5e8f","rename":"\u91cd\u547d\u540d","add_to_fav":"\u6dfb\u52a0\u5230\u6536\u85cf\u5939","search_in_path":"\u6587\u4ef6\u5939\u4e2d\u641c\u7d22","add_to_play":"\u6dfb\u52a0\u5230\u64ad\u653e\u5217\u8868","manage_fav":"\u7ba1\u7406\u6536\u85cf\u5939","refresh_tree":"\u5237\u65b0\u6811\u76ee\u5f55","manage_folder":"\u7ba1\u7406\u76ee\u5f55","close_menu":"\u5173\u95ed\u83dc\u5355","zip":"zip\u538b\u7f29","unzip":"zip\u89e3\u538b\u5230\u5f53\u524d","clipboard":"\u67e5\u770b\u526a\u8d34\u677f","full_screen":"\u5168\u5c4f\/\u9000\u51fa\u5168\u5c4f","tips":"\u63d0\u793a","ziping":"\u6b63\u5728\u538b\u7f29...","unziping":"\u6b63\u5728\u89e3\u538b...","moving":"\u79fb\u52a8\u64cd\u4f5c\u4e2d...","remove_title":"\u5220\u9664\u786e\u8ba4","remove_info":"\u786e\u8ba4\u5220\u9664\u9009\u4e2d\u5185\u5bb9\u5417\uff1f","name_isexists":"\u51fa\u9519\u4e86,\u8be5\u540d\u79f0\u5df2\u5b58\u5728\uff01","install":"\u5b89\u88c5","width":"\u5bbd","height":"\u9ad8","app":"\u5e94\u7528","app_store":"\u5e94\u7528\u5546\u5e97","app_create":"\u521b\u5efa\u5e94\u7528","app_edit":"\u4fee\u6539\u5e94\u7528","app_group_all":"\u5168\u90e8","app_group_game":"\u6e38\u620f","app_group_tools":"\u5de5\u5177","app_group_reader":"\u9605\u8bfb","app_group_movie":"\u5f71\u89c6","app_group_music":"\u97f3\u4e50","app_group_life":"\u751f\u6d3b","app_group_others":"\u5176\u4ed6","app_desc":"\u63cf\u8ff0","app_icon":"\u5e94\u7528\u56fe\u6807","app_icon_show":"url\u5730\u5740\u6216\u8be5\u76ee\u5f55","app_group":"\u5e94\u7528\u5206\u7ec4","app_type":"\u7c7b\u578b","app_type_url":"\u94fe\u63a5","app_type_code":"js\u6269\u5c55","app_display":"\u5916\u89c2","app_display_border":"\u65e0\u8fb9\u6846(\u9009\u4e2d\u5373\u65e0\u8fb9\u6846)","app_display_size":"\u8c03\u6574\u5927\u5c0f(\u9009\u4e2d\u5373\u53ef\u8c03\u6574)","app_size":"\u5c3a\u5bf8","app_url":"\u94fe\u63a5\u5730\u5740","app_code":"js \u4ee3\u7801","edit":"\u7f16\u8f91","edit_can_not":"\u4e0d\u662f\u6587\u672c\u6587\u4ef6","edit_too_big":"\u6587\u4ef6\u592a\u5927,\u4e0d\u80fd\u5927\u4e8e20M","open_default":"\u9ed8\u8ba4\u65b9\u5f0f\u6253\u5f00","open_ie":"\u6d4f\u89c8\u5668\u6253\u5f00","refresh":"\u5237\u65b0","refresh_all":"\u5f3a\u5236\u5237\u65b0","newfile":"\u65b0\u5efa\u6587\u4ef6","newfolder":"\u65b0\u5efa\u6587\u4ef6\u5939","newothers":"\u65b0\u5efa\u5176\u4ed6","path_loading":"\u8f7d\u5165\u4e2d...","go":"\u8d70\u7740!","go_up":"\u4e0a\u5c42","history_next":"\u524d\u8fdb","history_back":"\u540e\u9000","address_in_edit":"\u70b9\u51fb\u8fdb\u5165\u7f16\u8f91\u72b6\u6001","double_click_rename":"\u53cc\u51fb\u540d\u79f0\u91cd\u547d\u540d","double_click_open":"\u53cc\u51fb\u6253\u5f00","path_null":"\u8be5\u6587\u4ef6\u5939\u4e3a\u7a7a\uff0c\u53ef\u4ee5\u62d6\u62fd\u6587\u4ef6\u5230\u8be5\u7a97\u53e3\u4e0a\u4f20\u3002","upload":"\u4e0a\u4f20","upload_ready":"\u7b49\u5f85\u4e0a\u4f20...","uploading":"\u4e0a\u4f20\u4e2d...","upload_success":"\u4e0a\u4f20\u6210\u529f","upload_path_current":"\u5207\u6362\u5230\u5f53\u524d\u76ee\u5f55","upload_select":"\u9009\u62e9\u6587\u4ef6","upload_max_size":"\u6700\u5927\u5141\u8bb8","upload_size_info":"\u5982\u679c\u60f3\u914d\u7f6e\u66f4\u5927\uff0c\u8bf7\u4fee\u6539php.ini\u4e2d\u5141\u8bb8\u4e0a\u4f20\u7684\u6700\u5927\u503c\u3002\u9009\u62e9\u6587\u4ef6\u65f6,\u5927\u4e8e\u8be5\u914d\u7f6e\u7684\u5c06\u81ea\u52a8\u8fc7\u6ee4\u6389\u3002","upload_error":"\u4e0a\u4f20\u5931\u8d25","upload_muti":"\u591a\u6587\u4ef6\u4e0a\u4f20","upload_drag":"\u62d6\u62fd\u4e0a\u4f20","upload_drag_tips":"\u677e\u5f00\u5373\u53ef\u4e0a\u4f20!","path_not_allow":"\u6587\u4ef6\u540d\u4e0d\u5141\u8bb8\u51fa\u73b0","download":"\u4e0b\u8f7d","download_address":"\u4e0b\u8f7d\u5730\u5740","download_ready":"\u5373\u5c06\u4e0b\u8f7d","download_success":"\u4e0b\u8f7d\u6210\u529f\uff01","download_error":"\u4e0b\u8f7d\u5931\u8d25\uff01","download_error_create":"\u5199\u5165\u51fa\u9519!","download_error_exists":"\u8fdc\u7a0b\u6587\u4ef6\u4e0d\u5b58\u5728!","upload_error_null":"\u6ca1\u6709\u6587\u4ef6\uff01","upload_error_big":"\u6587\u4ef6\u5927\u5c0f\u8d85\u8fc7\u670d\u52a1\u5668\u9650\u5236","upload_error_move":"\u79fb\u52a8\u6587\u4ef6\u5931\u8d25\uff01","upload_error_exists":"\u8be5\u6587\u4ef6\u5df2\u5b58\u5728","upload_local":"\u672c\u5730\u4e0a\u4f20","download_from_server":"\u8fdc\u7a0b\u4e0b\u8f7d","save_path":"\u4fdd\u5b58\u8def\u5f84","upload_select_muti":"\u53ef\u9009\u62e9\u591a\u4e2a\u6587\u4ef6\u4e0a\u4f20","search":"\u641c\u7d22","searching":"\u641c\u7d22\u4e2d...","search_null":"\u6ca1\u6709\u641c\u7d22\u7ed3\u679c!","search_uplow":"\u533a\u5206\u5927\u5c0f\u5199","search_content":"\u641c\u7d22\u6587\u4ef6\u5185\u5bb9","search_info":"\u8bf7\u8f93\u5165\u641c\u7d22\u8bcd\u548c\u8def\u5f84\u8fdb\u884c\u641c\u7d22\uff01","search_ext_tips":"\u7528|\u9694\u5f00;\u4f8b\u5982 php|js|css<br\/>\u4e0d\u586b\u5219\u641c\u7d22\u9ed8\u8ba4\u6587\u672c\u6587\u4ef6","file_type":"\u6587\u4ef6\u7c7b\u578b","goto":"\u8df3\u8f6c\u5230","server_dwonload_desc":"\u4e2a\u4efb\u52a1\u52a0\u5165\u5230\u4e0b\u8f7d\u5217\u8868","parent_permission":"\u7236\u76ee\u5f55\u6743\u9650","root_path":"\u6211\u7684\u6587\u4ef6","lib":"\u5e93","fav":"\u6536\u85cf\u5939","desktop":"\u684c\u9762","browser":"\u6d4f\u89c8\u5668","my_cumputer":"\u6211\u7684\u7535\u8111","recycle":"\u56de\u6536\u7ad9","my_document":"\u6211\u7684\u6587\u6863","my_picture":"\u6211\u7684\u7167\u7247","my_music":"\u6211\u7684\u97f3\u4e50","my_movie":"\u6211\u7684\u89c6\u9891","my_download":"\u6211\u7684\u4e0b\u8f7d","ui_desktop":"\u684c\u9762","ui_filemanage":"\u6587\u4ef6\u7ba1\u7406","ui_editor":"\u7f16\u8f91\u5668","adminer":"adminer","ui_project_home":"\u9879\u76ee\u4e3b\u9875","ui_login":"\u767b\u9646","ui_logout":"\u9000\u51fa","setting":"\u7cfb\u7edf\u8bbe\u7f6e","setting_title":"\u9009\u9879","setting_user":"\u4e2a\u4eba\u4e2d\u5fc3","setting_password":"\u4fee\u6539\u5bc6\u7801","setting_password_old":"\u539f\u5bc6\u7801","setting_password_new":"\u4fee\u6539\u4e3a","setting_language":"\u8bed\u8a00\u8bbe\u7f6e","setting_member":"\u7528\u6237\u7ba1\u7406","setting_group":"\u7528\u6237\u7ec4\u7ba1\u7406","setting_group_add":"\u6dfb\u52a0\u7528\u6237\u7ec4","setting_group_edit":"\u7f16\u8f91\u7528\u6237\u7ec4","setting_theme":"\u4e3b\u9898\u5207\u6362","setting_wall":"\u66f4\u6362\u58c1\u7eb8","setting_wall_diy":"\u81ea\u5b9a\u4e49\u58c1\u7eb8\uff1a","setting_wall_info":"\u56fe\u7247url\u5730\u5740\uff0c\u672c\u5730\u56fe\u7247\u53ef\u4ee5\u53f3\u952e\u56fe\u7247\u6d4f\u89c8\u5668\u6253\u5f00\u5373\u53ef\u5f97\u5230","setting_fav":"\u6536\u85cf\u5939\u7ba1\u7406","setting_player":"\u64ad\u653e\u5668","setting_player_music":"\u97f3\u4e50\u64ad\u653e\u5668\u8bbe\u7f6e","setting_player_movie":"\u89c6\u9891\u64ad\u653e\u5668\u8bbe\u7f6e","setting_help":"\u4f7f\u7528\u5e2e\u52a9","setting_about":"\u5173\u4e8e\u4f5c\u54c1","setting_success":"\u4fee\u6539\u5df2\u751f\u6548\uff01","can_not_repeat":"\u4e0d\u5141\u8bb8\u91cd\u590d","absolute_path":"\u7edd\u5bf9\u5730\u5740","group":"\u7528\u6237\u7ec4","data_not_full":"\u6570\u636e\u63d0\u4ea4\u4e0d\u5b8c\u6574\uff01","default_user_can_not_do":"\u9ed8\u8ba4\u7528\u6237\u4e0d\u80fd\u64cd\u4f5c","default_group_can_not_do":"\u9ed8\u8ba4\u7528\u6237\u7ec4\u4e0d\u80fd\u64cd\u4f5c","username_can_not_null":"\u7528\u6237\u540d\u4e0d\u80fd\u4e3a\u7a7a\uff01","groupname_can_not_null":"\u7528\u6237\u7ec4\u540d\u4e0d\u80fd\u4e3a\u7a7a\uff01","groupdesc_can_not_null":"\u7528\u6237\u7ec4\u63cf\u8ff0\u4e0d\u80fd\u4e3a\u7a7a\uff01","group_move_user_error":"\u6240\u5c5e\u7528\u6237\u7ec4\u7528\u6237\u79fb\u52a8\u5931\u8d25","group_already_remove":"\u8be5\u7528\u6237\u7ec4\u5df2\u88ab\u5220\u9664","group_not_exists":"\u8be5\u7528\u6237\u7ec4\u4e0d\u5b58\u5728","member_add":"\u6dfb\u52a0\u7528\u6237","password_null_not_update":"\u5bc6\u7801\u4e0d\u586b\u8868\u793a\u4e0d\u66f4\u6539","if_save_file":"\u6587\u4ef6\u5c1a\u672a\u4fdd\u5b58,\u662f\u5426\u4fdd\u5b58\uff1f","if_remove":"\u786e\u8ba4\u5220\u9664","member_remove_tips":"\u5220\u9664\u540e\u8be5\u7528\u6237\u76ee\u5f55\u4f1a\u88ab\u6e05\u7a7a","group_remove_tips":"\u5220\u9664\u540e\u8be5\u7528\u6237\u7ec4\u7528\u6237\u65e0\u6cd5\u767b\u9646<br\/>(\u9700\u8981\u91cd\u65b0\u8bbe\u7f6e\u7528\u6237\u7ec4)","group_name":"\u7528\u6237\u7ec4\u540d","group_name_tips":"\u5efa\u8bae\u82f1\u6587\u540d\uff0c\u4e0d\u80fd\u91cd\u590d","group_desc":"\u5c55\u793a\u540d\u79f0","group_desc_tips":"\u7ec4\u540d\u63cf\u8ff0","group_role_ext":"\u6269\u5c55\u540d\u9650\u5236","group_role_ext_tips":"\u591a\u4e2a\u7528|\u5206\u9694\u5f00","group_role_file":"\u6587\u4ef6\u7ba1\u7406","group_role_upload":"\u5141\u8bb8\u4e0a\u4f20","group_role_user":"\u7528\u6237\u6570\u636e","group_role_group":"\u7528\u6237\u7ec4\u7ba1\u7406","group_role_member":"\u7528\u6237\u7ba1\u7406","group_role_mkfile":"\u65b0\u5efa\u6587\u4ef6","group_role_mkdir":"\u65b0\u5efa\u6587\u4ef6\u5939","group_role_pathrname":"\u91cd\u547d\u540d","group_role_pathdelete":"\u6587\u4ef6(\u5939)\u5220\u9664","group_role_pathinfo":"\u6587\u4ef6(\u5939)\u5c5e\u6027","group_role_pathmove":"\u79fb\u52a8(\u590d\u5236\/\u526a\u5207\/\u7c98\u8d34\/\u62d6\u62fd\u64cd\u4f5c)","group_role_zip":"zip\u538b\u7f29","group_role_unzip":"zip\u89e3\u538b","group_role_search":"\u641c\u7d22","group_role_filesave":"\u7f16\u8f91\u4fdd\u5b58\u6587\u4ef6","group_role_can_upload":"\u4e0a\u4f20\u4e0b\u8f7d","group_role_download":"\u8fdc\u7a0b\u4e0b\u8f7d","group_role_passowrd":"\u4fee\u6539\u5bc6\u7801","group_role_config":"\u7528\u6237\u6570\u636e","group_role_fav":"\u6536\u85cf\u5939\u64cd\u4f5c(\u6dfb\u52a0\/\u7f16\u8f91\/\u5220\u9664)","group_role_list":"\u5217\u8868\u67e5\u770b","group_role_member_add":"\u6dfb\u52a0\u7528\u6237","group_role_member_edit":"\u7f16\u8f91\u7528\u6237","group_role_member_del":"\u5220\u9664\u7528\u6237","group_role_group_add":"\u6dfb\u52a0\u7528\u6237\u7ec4","group_role_group_edit":"\u7f16\u8f91\u7528\u6237\u7ec4","group_role_group_del":"\u5220\u9664\u7528\u6237\u7ec4","group_role_ext_warning":"\u4e0d\u5141\u8bb8\u6b64\u7c7b\u6587\u4ef6\u7684\u4e0a\u4f20,<br\/>\u91cd\u547d\u540d(\u91cd\u547d\u540d\u4e3a\u6307\u5b9a\u6269\u5c55\u540d),<br\/>\u7f16\u8f91\u4fdd\u5b58,\u8fdc\u7a0b\u4e0b\u8f7d,\u89e3\u538b","group_tips":"<li>1.\u7528\u6237\u7ec4\u540d\u4e0d\u80fd\u91cd\u590d\uff0c\u4fee\u6539\u7ec4\u540d\u540e\u539f\u5c5e\u4e8e\u6539\u7ec4\u7528\u6237\u4f1a\u81ea\u52a8\u5173\u8054<\/li><li>2.\u6269\u5c55\u540d\u9650\u5236\u5173\u7cfb\u7cfb\u7edf\u5b89\u5168\u6027\uff0c\u8bf7\u52a1\u5fc5\u8c28\u614e\u64cd\u4f5c<i>(\u679c\u5728web\u76ee\u5f55\u4e0b\u65b0\u5efaphp;\u5c31\u610f\u5473\u7740\u6539\u7a0b\u5e8f\u7684\u6743\u9650\u5bf9\u6b64\u7528\u6237\u5f62\u540c\u865a\u8bbe)<\/i><\/li><li>3.\u6237\u7ba1\u7406\u3001\u6743\u9650\u7ec4\u7ba1\u7406\uff1b\u67e5\u770b\u6743\u9650\u548c\u589e\u5220\u6539\u6743\u9650\u662f\u7ed1\u5b9a\u7684\uff1b\u7a0b\u5e8f\u4f1a\u81ea\u52a8\u5173\u8054<\/li><li>4.\u8bbe\u5b9a\u6743\u9650\u7ec4\u80fd\u6dfb\u52a0\u6743\u9650\u7ec4\u540e\uff0c\u540e\u7eed\u6743\u9650\u662f\u4e0d\u7ee7\u627f\u7684<i>\uff08\u6b64\u6743\u9650\u76f8\u5f53\u4e8e\u6700\u9ad8\u6743\u9650\uff09<\/i><\/li>","not_null":"\u5fc5\u586b\u9879\u4e0d\u80fd\u4e3a\u7a7a!","picture_can_not_null":"\u56fe\u7247\u5730\u5740\u4e0d\u80fd\u4e3a\u7a7a!","rname_success":"\u91cd\u547d\u540d\u6210\u529f\uff01","please_inpute_search_words":"\u8bf7\u8f93\u5165\u8981\u641c\u7d22\u7684\u5b57\u7b26\u4e32","remove_success":"\u5220\u9664\u6210\u529f\uff01","remove_fali":"\u5220\u9664\u5931\u8d25!","clipboard_null":"\u526a\u8d34\u677f\u4e3a\u7a7a\uff01","create_success":"\u65b0\u5efa\u6210\u529f\uff01","create_error":"\u65b0\u5efa\u5931\u8d25,\u8bf7\u68c0\u67e5\u76ee\u5f55\u6743\u9650\uff01","copy_success":"\u3010\u590d\u5236\u3011\u2014\u2014 \u8986\u76d6\u526a\u8d34\u677f\u6210\u529f!","cute_success":"\u3010\u526a\u5207\u3011\u2014\u2014 \u8986\u76d6\u526a\u8d34\u677f\u6210\u529f!","clipboard_state":"\u526a\u5207\u677f\u72b6\u6001:","no_permission_write":"\u8be5\u6587\u4ef6\u6216\u76ee\u5f55\u6ca1\u6709\u5199\u6743\u9650","copy_not_exists":"\u6765\u6e90\u4e0d\u5b58\u5728","current_has_parent":"\u76ee\u6807\u6587\u4ef6\u5939\u662f\u6e90\u6587\u4ef6\u5939\u7684\u5b50\u6587\u4ef6\u5939!","past_success":"<b>\u7c98\u8d34\u64cd\u4f5c\u5b8c\u6210<\/b>","cute_past_success":"<b>\u526a\u5207\u64cd\u4f5c\u5b8c\u6210<\/b>(\u6e90\u6587\u4ef6\u88ab\u5220\u9664,\u526a\u8d34\u677f\u6e05\u7a7a)","zip_success":"\u538b\u7f29\u5b8c\u6210","not_zip":"\u4e0d\u662f\u538b\u7f29\u6587\u4ef6","zip_null":"\u6ca1\u6709\u9009\u62e9\u7684\u6587\u4ef6\u6216\u76ee\u5f55","unzip_success":"\u89e3\u538b\u5b8c\u6210","gotoline":"\u8df3\u8f6c\u5230\u884c","path_is_current":"\u6240\u6253\u5f00\u8def\u5f84\u548c\u5f53\u524d\u8def\u5f84\u4e00\u6837\uff01","path_exists":"\u8be5\u540d\u79f0\u5df2\u5b58\u5728\uff01","undo":"\u64a4\u9500","redo":"\u53cd\u64a4\u9500","preview":"\u9884\u89c8","wordwrap":"\u81ea\u52a8\u6362\u884c(\u4e0d\u81ea\u52a8\u6362\u884c)","char_all_display":"\u663e\u793a\u4e0d\u53ef\u89c1\u5b57\u7b26(\u9690\u85cf)","auto_complete":"\u81ea\u52a8\u63d0\u793a(\u53d6\u6d88)","code_theme":"\u4ee3\u7801\u98ce\u683c","font_size":"\u5b57\u4f53","button_ok":"\u786e\u5b9a","button_submit":"\u63d0\u4ea4","button_set":"\u8bbe\u7f6e","button_cancle":"\u53d6\u6d88","button_edit":"\u7f16\u8f91","button_save":"\u4fdd\u5b58","button_save_all":"\u4fdd\u5b58\u5168\u90e8","button_not_save":"\u4e0d\u4fdd\u5b58","button_add":"\u6dfb\u52a0","button_back_add":"\u8fd4\u56de\u6dfb\u52a0","button_del":"\u5220\u9664","button_save_edit":"\u4fdd\u5b58\u4fee\u6539","button_save_submit":"\u4fdd\u5b58\u63d0\u4ea4","button_select_all":"\u5168\u9009\/\u53cd\u9009","share":"分享"};
	var G = {
		is_root 	: 1,
		web_root 	: "/private/var/www/SNSCloud/",
		web_host 	: "<?php echo $_SERVER['SERVER_NAME']; ?>",
		static_path : "/circleinfo/",
		basic_path  : "<?php echo __FILE__; ?>",
		public_path : "<?php echo $this->session->get('shareDiskPath'); ?>",
		upload_max  : "<?php echo ini_get('upload_max_filesize'); ?>",
		version 	: "10.61",
		app_host 	: "<?php echo $_SERVER['SERVER_NAME']; ?>",

		this_path	: "<?php echo $this->session->get('cDiskPath'); ?>",//当前绝对路径
		myhome   	: "<?php echo $this->session->get('cDiskPath'); ?>",//当前绝对路径	

		json_data	: "",//用于存储每次获取列表后的json数据值。
		list_type	: "icon",		//文件列表显示方式 list/icon
		sort_field 	: "name", //列表排序依照的字段  
		sort_order 	: "up",	//列表排序升序or降序
		musictheme	: "qqmusic",
		movietheme	: "webplayer"
	};
	seajs.config({
		base: "/circleinfo/js/",
		preload: ["lib/jquery-1.8.0.min"]
	});
	seajs.use("_dev/src/explorer/main");
</script>
