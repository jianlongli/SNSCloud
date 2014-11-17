<?php echo $this->tag->stylesheetLink('./eduis/css/stylesp.css'); ?>
<?php echo $this->tag->stylesheetLink('./eduis/css/style.css'); ?>
<?php echo $this->tag->stylesheetLink('./eduis/css/circle.css'); ?>

<?php echo $this->tag->javascriptInclude('./eduis/js/jquery.min.js'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/circlemanage.js'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/_dev/src/explorer/common.js'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/zz.js'); ?>
	<div class="init_loading"><div><img src="<?php echo @$controllerName=='session' ? '../' : './'; ?>static/images/loading_simple.gif"/></div></div>
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
                    <li><span class="navmenu_on" id="risingmenu1" ><a href="#" >圈子通知</a></span></li>
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
		<div class="top_right">
		<div id="kakamenu">
			<?php if ($this->session->get('auth') != '') { ?>
			<!-- ToDo:点击弹出菜单 -->
			<a href="#" id='topbar_user' data-toggle="dropdown"><i class="icon-user"></i>admin<b class="caret"></b></a>
			<ul class="dropdown-menu menu-topbar_user fadein" role="menu" aria-labelledby="topbar_user">
				<li><a href="javascript:core.setting('user');"><i class="font-icon icon-user"></i>用户设置</a></li>
				<!-- 如果用户是root用户 -->
					<li><a href="javascript:core.setting('member');"><i class="font-icon icon-group"></i>成员管理</a></li>
				<!-- End if -->

				<li><a href="javascript:core.setting('about');"><i class="font-icon icon-info-sign"></i>关于</a></li>
				<li role="presentation" class="divider"></li>
				<li><a href="session/end"><i class="font-icon icon-off"></i>退出</a></li>
			</ul>		
			<?php } ?>
		</div>
		</div>
		<div style="clear:both"></div><!-- top_right End -->
              	
              </div>
		<div class='frame-right'>
			<div class="circlemanageDiv">
				<div class="manage-left pull-left">
					<div class="manage-left-inner">
						<ul>
							<li class="current" data-name="circleinfo">圈子信息</li>	
							<li data-name="member">成员管理</li>	
							<li data-name="experts">专家聘请</li>	
							<li data-name="info">信息统计</li>	
						</ul>	
						<input type="hidden" name="circleid" id="circleid" value="<?php echo $circleId;?>"/>
						<div class='manage-left pull-left'>
							<div class="manageContent">
								
							</div>
						</div>
					</div>
				</div>
				<div class="manage-right pull-right">
					<ul class="cm-right-menu">
						<li class="sendNotice" ><a href="#">发送通知</a></li>
						<li class="work" id="zuoye" data-id="<?php echo $circleId; ?>"><a href="#">布置作业</a></li>
						<li class="discuss"><a href="#" id="discuss_begin_button" data-id="<?php echo $circleId;?>">发起讨论</a></li>
						<li class="circlemanage"><a href="/circlemanage?id=<?php echo $circleId;?>">全资管理</a></li>
					</ul>	
				</div>
				<div class="clearB"></div>
			</div>
		</div><!-- / frame-right end-->
	</div><!-- / frame-main end-->
<script src="./circlestatic/js/lib/artDialog/jquery-artDialog.js?skin=default" type="text/javascript"></script>
<script>
	
	$(function(){
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
		
		$(".sendNotice").live('click' , function(){
		
			art.dialog.open('/notice/index/?id=<?php echo $circleId;?>',{
				fixed : true,
				title : '发通知',
				lock : true,
				height : '660px',
				width : '1000px',
			});
		});




		_circleId = $("#circleid").val();
		$.circlemanage._init('circleinfo',{id:_circleId});
		
		$(".manage-left-inner ul li").live('click', function(){
			$(".manage-left-inner ul li").removeClass("current");
			$(this).addClass("current");
			$.circlemanage._init($(this).data('name'),{id:_circleId});
		});
		$('.init_loading').fadeOut(450).addClass('pop_fadeout');
		
		/*add member*/
		$("#add_member_button").live('click' , function () {
			var _filterId = $('#existUserid').val();
    			_filterId = _filterId ? _filterId : '';
    			art.dialog.open ('/circle/getmemberlist/?id=' + _filterId , {
				id : 'get_member_list_div',
				fixed : true,
				title : '圈子管理员',
				lock : true,
				height : '480px',
				width : '600px',
				ok:function() {
					$.each(this.iframe.contentWindow.$("input[data-name]:checked"), function(i, n){
						var _id = $(n).val();
						$.circlemanage._setData( '/circlemanage/membermanage' ,{id:_circleId, type: 'add', memberId:_id} , memberManageCallback );
					});
				},
				cancel: true
			});
		});

		
		/*Choose quanzhu*/
		$('#choose_qz_quanzhu_button').live('click', function(){
			var _filterId = $('input[name="quanzhuId"]').val();
    		_filterId = _filterId ? _filterId : '';
    		art.dialog.data('memberId', $('#quanzhuId').val());
    		art.dialog.open ('/circle/getquanzhu/?id=' + _filterId , {
				id : 'get_member_list_div',
				fixed : true,
				title : '重设圈主',
				lock : true,
				height : '480px',
				width : '600px',
				ok:function() {
					var _quanzhu_name = this.iframe.contentWindow.$("input[data-name]:checked").attr('data-name');
					var _quanzhu_id = this.iframe.contentWindow.$("input[data-name]:checked").val();
					$('#quanzhuId').val(_quanzhu_id);
					$('#quanzhunameid').val(_quanzhu_name);
				},
				cancel: true
			});
    		
		});
		
		/*Choose admin*/
		$('#check_qz_admin_button').live('click', function(){
    		var _filterId = $('#quanzhuId').val();
    		_filterId = _filterId ? _filterId : '';
    		art.dialog.data('memberId', $('input[name="qz_admin_id"]').val());
    		art.dialog.open ('/circle/getmemberlist/?id=' + _filterId , {
				id : 'get_member_list_div',
				fixed : true,
				title : '圈子管理员',
				lock : true,
				height : '480px',
				width : '600px',
				ok:function() {
					var _adminList  = _admin_id_list = '';
					$.each(this.iframe.contentWindow.$("input[data-name]:checked"), function(i, n){
						var _name = $(n).attr('data-name');
						var _id = $(n).val();
						_adminList += _name + ',';
						_admin_id_list += _id + ',';
					});
					_adminList = _adminList ? _adminList.substring(0,_adminList.length-1) : '';
					_admin_id_list = _admin_id_list ? _admin_id_list.substring(0,_admin_id_list.length-1) : '';
					$('input[name="qz_admin"]').val(_adminList);
					$('input[name="qz_admin_id"]').val(_admin_id_list);
				},
				cancel: true
			});
    	});
    	
    	/*Commit circle update*/
	    $('#circleUpdateForm').live('submit',function(){
			$.common._ajax('circleUpdateForm',circleUpdateFormCallback);
			//$('.init_loading').fadeOut(450).addClass('pop_fadeout');
			return false;
		});
    	
    	/*Page*/
		$(".syspage").live('click',function (){
			_param = {id : _circleId};
			_url = $(this).attr("data");
			if($(".current").data("name") == 'member'){
				_key = $("#keyWord").val();
				if(_key.length > 0 )
					_param.key = _key;
				$.circlemanage._getData( _url , $(".current").data("name"), _param );
			}
		});
		
		/*Member search*/
		$(".memberSearch").live('click',function(){
			var _key = $("#keyWord").val();
			_param = {id : _circleId};
			if(_key.length > 0 )
				_param.key = _key;
			_url = '/circlemanage/member';
			$.circlemanage._getData( _url , $(".current").data("name"), _param );
		});
		
		$(".memberManage").live('click' , function(){
			$.circlemanage._setData( '/circlemanage/membermanage' ,{id: $(this).data('id') , type: $(this).data('type')} , memberManageCallback );
		});
    	
	});
	
	function circleUpdateFormCallback( _data ){
		alert(_data.data);
	}
	
	function memberManageCallback( _data ){
		$.circlemanage._init($('li[class="current"]').data('name'),{id:_circleId});
	}

	
</script>
