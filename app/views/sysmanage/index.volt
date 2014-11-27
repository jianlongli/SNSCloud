<?php echo $this->tag->stylesheetLink('./static/style/skin/metro/app_explorer.css'); ?>
<?php echo $this->tag->stylesheetLink('./eduis/css/stylesp.css'); ?>
<?php echo $this->tag->stylesheetLink('./eduis/css/style.css'); ?>
<?php echo $this->tag->stylesheetLink('./eduis/css/sysmanage.css'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/jquery.min.js'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/shipj.js'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/hover.js'); ?>

<?php echo $this->tag->javascriptInclude('./circlestatic/js/swfupload.js'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/swfupload.queue.js'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/fileprogress.js'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/handlers.js'); ?>

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
					<?php $authInfo = $this->session->get('auth');?>
					<?php if ($authInfo != '') { ?>
					<!-- ToDo:点击弹出菜单 -->
					<a href="#" id='topbar_user' data-toggle="dropdown"><i class="icon-user"></i><?php echo $authInfo['username'];?><b class="caret"></b></a>
					<input type="hidden" value="<?php echo $authInfo['roleids'];?>" id='roleid'/> 
					<ul class="dropdown-menu menu-topbar_user fadein" role="menu" aria-labelledby="topbar_user">
						<li><a href="/system#personal">个人信息</a></li>
						<li><a href="/system#invite">圈子邀请(3)</a></li>
						<li><a href="/system#member">用户管理</a></li>
						<li><a href="/system#company">单位管理</a></li>
						<li><a href="/system#circle">圈子审批</a></li>
						<li><a href="/system#setting">系统设置</a></li>
						<li><a href="/system#log">系统日志</a></li>
						<li><a href="javascirpt:;">退出</a></li>
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
<script src="./circlestatic/js/_dev/src/explorer/sysmanage.js" type="text/javascript"></script>
<script src="./circlestatic/js/_dev/src/explorer/common.js" type="text/javascript"></script>

<script type="text/javascript">
$(function(){
	
	$.sysmanage._init('personal');
	$(".tagMenu li a ").live('click',function(){
		$(".tagMenu li a").removeClass("dijxt");
		$(this).addClass("dijxt");
		$.sysmanage._init($(this).attr('data'));
	});
	

	/*Page*/
	$(".syspage").live('click',function (){
		var _action = $(".dijxt").attr("data");
		var _url = $(this).attr("data");
		_param ={};
		if(_action == 'company'){
			_key = $("#companyKeyH").val();
			_regional = $("#regionalOptionH").val();
			if(_key.length > 0 )
				_param.key = _key;
			if(_regional.length > 0 && _regional != 0)
				_param.regional = _regional;
			
			if(_param.key == "undefined" && _param.regional == "undefined"){
				$.sysmanage._getData( _url , _action);
			}else{
				$.sysmanage._getData( _url , _action, _param );
			}
		}else if(_action == 'member'){
			_key = $("#memberKeyH").val();
			if(_key.length > 0 )
				_param.key = _key;
			if(_param.key == "undefined"){
				$.sysmanage._getData( _url , _action);
			}else{
				$.sysmanage._getData( _url , _action, _param );
			}			
		}else if(_action == 'circle'){
			_key = $("#circleKeyH").val();
			if(_key.length > 0 )
				_param.key = _key;
			if(_param.key == "undefined"){
				$.sysmanage._getData( _url , _action);
			}else{
				$.sysmanage._getData( _url , _action, _param );
			}			
		}else if(_action == 'invite'){
			_key = $("#inviteKeyH").val();
			
		
			if(_key.length > 0 )
				_param.key = _key;
			if(_param.key == "undefined"){
				$.sysmanage._getData( _url , _action);
			}else{
				$.sysmanage._getData( _url , _action, _param );
			}		
		}else{
			$.sysmanage._getData( _url , _action );
		}
		
	});
	
	/*Company search*/
	$(".companySearch").live('click',function(){
		var _action = $(".dijxt").attr("data");
		_param ={};
		_key = $("#companyKey").val();
		_regional = $("#regionalOption").children('option:selected').val();
		if(_key.length > 0 )
			_param.key = _key;
		if(_regional.length > 0 && _regional != 0)
			_param.regional = _regional;
			
		_url = 'sysmanage/company';
		
		if(_param.key == "undefined" && _param.regional == "undefined"){
			$.sysmanage._getData( _url , _action);
		}else{
			$.sysmanage._getData( _url , _action, _param );
		}
	});
	
	/*Member search*/
	$(".memberSearch").live('click',function(){
		var _action = $(".dijxt").attr("data");
		var _key = $("#memberKey").val();
		_param ={};
		if(_key.length > 0 )
			_param.key = _key;
		_url = 'sysmanage/member';
		if(_param.key == "undefined")
			$.sysmanage._getData( _url , _action);
		else
			$.sysmanage._getData( _url , _action, _param );
	});
	
	/*Invite search*/
	$(".inviteSearch").live('click' , function(){
		var _action = $(".dijxt").attr("data");
		var _key = $("#inviteKey").val();
		_param ={};
		if(_key.length > 0 )
			_param.key = _key;
		_url = 'sysmanage/invite';
		if(_param.key == "undefined")
			$.sysmanage._getData( _url , _action);
		else
			$.sysmanage._getData( _url , _action, _param );
		
	});
	
	/*Circle search*/
	$(".circleSearch").live('click',function(){
		var _action = $(".dijxt").attr("data");
		var _key = $("#circleKey").val();
		_param ={};
		if(_key.length > 0 )
			_param.key = _key;
		_url = 'sysmanage/circle';
		if(_param.key == "undefined")
			$.sysmanage._getData( _url , _action);
		else
			$.sysmanage._getData( _url , _action, _param );	
	});
	
	/*SelectPageSize*/
	$("#selectPageSize").live('change',function(){
		var _action = $(".dijxt").attr("data");
		var _url = $(this).children('option:selected').attr("data"); 
		$.sysmanage._getData( _url , _action );
	});
	

	
	/*Update personal information */
	$('#personalForm').live('submit',function(){
		$.common._ajax('personalForm',personalformCallback);
		return false;
	});
	
	/*Delete member*/
	$(".Delopration").live('click',function () {
		var _id = $(this).data("id");
		var _action = $(".dijxt").attr("data");
		$.sysmanage._delData(_action,_id,DelCallback);
	});
	
	/*Circle manage*/
	$(".circleManage").live('click',function(){
		var _action = $(".dijxt").attr("data");
		var _type = $(this).data("type");
		var _id = $(this).data("id");
		if( _type == 'del'){
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
	
	/*Member process*/
	$(".memberManage").live('click',function () {
		var _type = $(this).attr("data");
		art.dialog.open('/sysmanage/member/add',{
			id: 'memberAdd',
			fixed : true,
			title : '新增用户',
			lock : true,
			height : '460px',
			width : '700px',
		});
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
		var _action = $(".dijxt").attr("data");
		var _id = '';
		$.each($('input[name="chkItem[]"]:checked'), function(i, n){
			_id += $(this).val()+',';
		});

		$.sysmanage._delData(_action,_id,DelCallback);
	});
	
	/*
	$("#personalUpload").live('click', function(){
		$('object').click();
		$('#SWFUpload_0').click();
		alert(4);
	});
	
	$.common._swfUpload(uploadSuccess, queueComplete);
	*/
	
	/*Circle detail infomation */
	$(".circleDetail").live('click' , function(){
		var _id = $(this).data('id');
		var _name = $(this).data('name');
		art.dialog.open('/sysmanage/circle/detail?id='+_id,{
			id: 'circleDetail',
			fixed : true,
			title : _name,
			lock : true,
			height : '460px',
			width : '700px',
		});
	});
	
	/*Invite manage */
	$(".inviteManage").live('click' , function(){
		var _action = $(".dijxt").attr("data");
		var _param = {};
		_param.id = $(this).data('id');
		_param.type = $(this).data('type');
		
		$.sysmanage._updateData(_action,_param,updateCallback);
	});
	
	
	$("body").click(function(){
		$(".menu-topbar_user").css('display') == 'none' ? '' : $(".menu-topbar_user").hide();
	});	
	$("#topbar_user").click(function(){
		$(".menu-topbar_user").css('display') == 'none' ? $(".menu-topbar_user").show() : $(".menu-topbar_user").hide();
		return false;
	});		
	
});

function personalformCallback(data){
	$.common._showMsg ('message', data.data);
}

function updateCallback(_data){
	if(_data.code){
		$.common._showMsg ('message', _data.data);
		var _currentUrl = $(".currentClass").attr("data");
		var _action = $(".dijxt").attr("data");
		$.sysmanage._getData( _currentUrl , _action);
	}else{
		alert(_data.data);
		$.common._showMsg ('message', _data.data);
	}

}

function DelCallback(_data){
	$.each(_data , function (i,n ){
		console.log(i+ '=======' +n);
	});
	if(_data.code){
		$.common._showMsg ('message', _data.data);
		var _currentUrl = $(".currentClass").attr("data");
		var _action = $(".dijxt").attr("data");
		$.sysmanage._getData( _currentUrl , _action);
	}else{
		alert(_data.data);
		$.common._showMsg ('message', _data.data);
	}
}

function queueComplete (){}
function uploadSuccess ( _file, _data) {}
</script>

	




