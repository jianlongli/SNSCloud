<?php echo $this->tag->stylesheetLink('./static/style/skin/metro/app_explorer.css'); ?>
<?php echo $this->tag->stylesheetLink('./eduis/css/stylesp.css'); ?>
<?php echo $this->tag->stylesheetLink('./eduis/css/style.css'); ?>
<?php echo $this->tag->stylesheetLink('./eduis/css/sysmanage.css'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/jquery.min.js'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/shipj.js'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/hover.js'); ?>

<div class="init_loading dn"><div><img src="./static/images/loading_simple.gif"/></div></div>

<div class="frame-main">
	<div class='frame-left'>
		<div class='GiLtop'><h2>我的圈子</h2></div>
		<!--代码开始-->
    	<div id="wrapper-250">
	        <ul class="accordion">
	        	<li id="one" class="files"> <a href="index">全部文件</a>
	            	<ul class="sub-menu"></ul>
	            </li>
	            <li id="two" class="cricle"> <a class="active" href="circle" value='32'>我的圈子</a>
	            	<ul class="sub-menu"  style="display: block;">
	                	<li><a href="#"><em>01</em>我的圈子1</a></li>
	                    <li><a href="#"><em>02</em>我的圈子2</a></li>
	                </ul>
	            </li>
	            <li id="three" class="cloud"> <a href="#three">我的讨论</a>
	            </li>
	            <li id="four" class="sign"> <a href="#four">外来文件</a>
	            	<ul class="sub-menu">
	                	<li><a href="#"><em>01</em>外来文件1</a></li>
	                    <li><a href="#"><em>02</em>外来文件2</a></li>
	                    <li><a href="#"><em>03</em>外来文件3</a></li>
	                </ul>
	            </li>
			</ul>
		</div>
        <!--代码结束-->
	</div><!-- / frame-left end-->
		
	<div class="GIRight1">
		<div id="rising_menu">
			<div id="navmenu">
				<ul>
					<li><span class="navmenu_on" id="risingmenu1" onmouseover="doClick_risingmenu(this);"><a href="#" >圈子通知</a></span></li>
				</ul>
			</div>
			<div class="submenu">
				<div class="none" id="sub_con1" style="display: block; width: 100%; min-width: 760px;" border="1" align="center" cellpadding="0" cellspacing="0">
					<marquee scrollAmount=3 hspace="100" onmouseover="stop()" onmouseout="start()">
						<a href="#">test test test test test</a>
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
		
			<div id="message" style="display: none;"></div>
		<div class='frame-right'>
			<div class="manage-div">
			 <!---------- conent start ---------->
              <div class="XTglInfo">
              	<div class="XTglInfoul">
                    <ul class="tagMenu">
                        <li><a href="#personal" data="personal" class="dijxt" >个人信息</a></li>
                        <li><a href="#invite" data="invite">圈子邀请</a></li>
                        <li><a href="#member" data="member">用户管理</a></li>
                        <li><a href="#company" data="company" >单位管理</a></li>
                        <li class="dn"><a href="#customer" data="customer" >区域管理</a></li>
                        <li><a href="#circle" data="circle" >圈子管理</a></li>
                        <li><a href="#setting" data="setting" >系统设置</a></li>
                        <li><a href="#log" data="log" >系统日志</a></li>
                    </ul>
                </div>
                <div class="XTglInfodiv">
                	
                </div>
                 <div class="clear"></div>
              </div>							
			</div>
			
			<!--
			<div style="width: 60px;float: left;">
				<div id='spanButtonPlaceHolder'></div>
			</div>
			<input id="btnCancel" type="button" value="取消上传" onclick="swfu.cancelQueue();" disabled="disabled" style="font-size: 8pt; height: 29px;margin-left: 50px;" />
			<div class="fieldset flash" id="fsUploadProgress" style="display: none;"></div>
			-->
			 <!---------- conent end ---------->
		</div><!-- / frame-right end-->
	</div>
</div><!-- / frame-main end-->
	
<script src="./static/js/lib/artDialog/jquery-artDialog.js?skin=default" type="text/javascript"></script>
<script src="./circlestatic/js/_dev/src/explorer/system.js" type="text/javascript"></script>
<script src="./circlestatic/js/_dev/src/explorer/common.js" type="text/javascript"></script>
<script type="text/javascript">
	
	$(function(){
		$('.init_loading').fadeOut(450).addClass('pop_fadeout');
		$.system._init('personal');
		$(".tagMenu li a ").live('click',function(){
			$(".tagMenu li a").removeClass("dijxt");
			$(this).addClass("dijxt");
			$.system._init($(this).attr('data'));
			$('.init_loading').fadeOut(450).addClass('pop_fadeout');
		});	
		
		/*Page*/
		$(".syspage").live('click',function (){
			_param = {};
			_url = $(this).attr("data");
			_key = $("#keyWord").val();
			if(_key.length > 0 )
				_param.key = _key;
			$.system._getData( _url , $(".dijxt").attr("data") ,_param);
		});
		
		/*search*/
		$(".Search").live('click',function(){
			var _key = $("#keyWord").val();
			_param = {};
			if(_key.length > 0 )
				_param.key = _key;
			
			if($(".dijxt").attr("data") =='company'){	
				_regional = $("#regionalOption").children('option:selected').val();	
				if(_regional.length > 0 && _regional != 0)
					_param.regional = _regional;
			}
			_url = '/system/'+$(".dijxt").attr("data");
			$.system._getData( _url , $(".dijxt").attr("data") , _param );
		});
		
		$("#selectPageSize").live('click' , function(){
			_url = $(this).children('option:selected').attr("data"); 
			$.system._getData( _url , $(".dijxt").attr("data") , {} );
		});
		
		/*Delete member*/
		$(".Delopration").live('click',function () {
			$.system._ajxRequest( '/system/' + $(".dijxt").attr("data") + '/del' , { id: $(this).data('id')} , memberCallback);
		});
		
		/*Choose delete*/
		$("#chooseAll").live('click',function(){
			if($(this).attr("checked") == 'checked'){
				$('input[name^="chkItem"]').attr('checked','checked');
			}else{
				$('input[name^="chkItem"]').removeAttr('checked');
			}
		});
	
		$('input[name="chkItem[]"]').live('click',function(){
			var _count = $('input[name="chkItem[]"]').size();
			var _checked_count = $('input[name="chkItem[]"]:checked').size();
			if (_checked_count != _count) {
				$('#chooseAll').removeAttr('checked');
			} else if (_checked_count == _count) {
				$('#chooseAll').attr('checked','checked');
			}
		});
	
		$("#memberDelBtn").live('click',function(){
			var _id = '';
			$.each($('input[name="chkItem[]"]:checked'), function(i, n){
				_id += $(this).val()+',';
			});
			$.system._ajxRequest( '/system/' + $(".dijxt").attr("data") + '/del' , { id: _id} , memberCallback);
		});
		
		$(".memberManage").live('click',function () {
			var _type = $(this).attr("data");
			art.dialog.open('/system/member/add',{
				id: 'memberAdd',
				fixed : true,
				title : '新增用户',
				lock : true,
				height : '460px',
				width : '700px',
			});
		});
	
		/*Invite manage */
		$(".inviteManage").live('click' , function(){
			$.system._ajxRequest( '/system/invite/update' , { id: $(this).data('id') , type:$(this).data('type') }, inviteCallback);
		});
		
		/*Circle manage*/
		$(".circleManage").live('click',function(){
			var _action = $(".dijxt").attr("data");
			var _type = $(this).data("type");
			var _id = $(this).data("id");
			if( _type == 'del'){
				$.system._ajxRequest( '/system/' + $(".dijxt").attr("data") + '/del' , { id: _id} , memberCallback);
				$.sysmanage._delData(_action,_id,DelCallback);
			}else{
				art.dialog.open('/sysmanage/circle/update?id='+_id,{
					id: 'circleReview',
					fixed : true,
					title : '圈子审核',
					lock : true,
					height : '460px',
					width : '700px',
				});
				//$.sysmanage._updateData(_action,{id:_id},DelCallback);
			}
		});
		
	});
		
	function systemCallback( _data ){
		$.system._init($('li a[class="dijxt"]').attr('data'));
	}
	
	function inviteCallback( _data ){
		if( _data.code ){
			var _id = _data.data.id;
			_content = _data.data.status ==1 ? '<a href="#" style="color:green;">已加入</a>' : '<a href="#" style="color:red;">已拒绝</a>';
			$("#invite_" + _id).html(_content);
		}else{
			alert( _data.data );
		}
	}
	function memberCallback( _data ){
		//if( _data.code ){
			$.system._init($(".dijxt").attr("data"));
		//}else{
		//	alert(_data.data);
		//}
	}
	
	
</script>

	




