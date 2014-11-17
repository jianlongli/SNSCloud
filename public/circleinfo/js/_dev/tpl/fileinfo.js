var file_info = "<div class='pathinfo'>\
    <div class='p'>\
        <div class='icon file_icon'></div>\
        <input type='text' class='info_name' name='filename' value='{{name}}'/>\
        <div style='clear:both'></div>\
    </div>\
    <div class='line'></div>\
    <div class='p'>\
        <div class='title'>{{LNG.file_type}}:</div>\
        <div class='content'>{{ext}} {{LNG.file}}</div>\
        <div style='clear:both'></div>\
    </div>\
    <div class='line'></div>\
    <div class='p'>\
        <div class='title'>{{LNG.address}}:</div>\
        <div class='content' id='id_fileinfo_path'>{{path}}</div>\
        <div style='clear:both'></div>\
    </div>\
    <div class='p'>\
        <div class='title'>{{LNG.size}}:</div>\
        <div class='content'>{{size_friendly}}  ({{size}} Byte)</div>\
        <div style='clear:both'></div>\
    </div>\
    <div class='line'></div>\
    <div class='p'>\
        <div class='title'>{{LNG.create_time}}</div>\
        <div class='content'>{{ctime}}</div>\
        <div style='clear:both'></div>\
    </div>\
    <div class='p'>\
        <div class='title'>{{LNG.modify_time}}</div>\
        <div class='content'>{{mtime}}</div>\
        <div style='clear:both'></div>\
    </div>\
    <div class='p'>\
        <div class='title'>{{LNG.last_time}}</div>\
        <div class='content'>{{atime}}</div>\
        <div style='clear:both'></div>\
    </div>\
</div>";

var path_info = "<div class='pathinfo'>\
    <div class='p'>\
        <div class='icon folder_icon'></div>\
        <input type='text' class='info_name' name='filename' value='{{name}}'/>\
        <div style='clear:both'></div>\
    </div>\
    <div class='line'></div>\
    <div class='p'>\
        <div class='title'>{{LNG.type}}:</div>\
        <div class='content'>{{LNG.folder}}</div>\
        <div style='clear:both'></div>\
    </div>\
    <div class='p'>\
        <div class='title'>{{LNG.address}}:</div>\
        <div class='content'>{{path}}</div>\
        <div style='clear:both'></div>\
    </div>\
    <div class='p'>\
        <div class='title'>{{LNG.size}}:</div>\
        <div class='content'>{{size_friendly}}  ({{size}} Byte)</div>\
        <div style='clear:both'></div>\
    </div>\
    <div class='p'>\
        <div class='title'>{{LNG.contain}}:</div> \
        <div class='content'>{{file_num}}  {{LNG.file}},{{folder_num}}  {{LNG.folder}}</div>\
        <div style='clear:both'></div>\
    </div>\
    <div class='line'></div>\
    <div class='p'>\
        <div class='title'>{{LNG.create_time}}</div>\
        <div class='content'>{{ctime}}</div>\
        <div style='clear:both'></div>\
    </div>\
    <div class='p'>\
        <div class='title'>{{LNG.modify_time}}</div>\
        <div class='content'>{{mtime}}</div>\
        <div style='clear:both'></div>\
    </div>\
    <div class='p'>\
        <div class='title'>{{LNG.last_time}}</div>\
        <div class='content'>{{atime}}</div>\
        <div style='clear:both'></div>\
    </div>\
</div>";

var path_info_more = "<div class='pathinfo'>\
    <div class='p'>\
        <div class='icon folder_icon'></div>\
        <div class='content' style='line-height:40px;margin-left:40px;'>\
            {{file_num}}  {{LNG.file}},{{folder_num}}  {{LNG.file}}</div>\
        <div style='clear:both'></div>\
    </div>\
    <div class='line'></div>\
    <div class='p'>\
        <div class='title'>{{LNG.size}}:</div>\
        <div class='content'>{{size_friendly}} ({{size}} Byte)</div>\
        <div style='clear:both'></div>\
    </div>\
</div>";

var file_share = "<div class='share'>\
	<style>\
	.tabnav ul{ margin:0; padding:0; list-style:none; }\
	.tabnav li{ padding:5 10px; border:1px solid #c2c2c2; float:left; }\
	.tabid { border:0px solid #c2c2c2; clear:both; }\
	</style>\
	<script language='javascript'>\
	function shareLink(action) {\
		var username = '';\
		if (action=='userShare') {\
			username = document.getElementById('username').value;\
		}\
		$.ajax({\
			type: 'POST',\
			dataType: 'json',\
			url: 'index/share',\
			data: 'action='+action+'&username='+username,\
			success: function(data) {\
				if (action=='linkShare') {\
					var objs = eval(data);\
					if (objs) {\
						document.getElementById('show_link').style.display='block';\
						document.getElementById('link_address').value=objs.data.path;\
					}\
				}\
				else {\
					var objs = eval(data);\
					if (objs.data=='分享成功') {\
						alert('分享成功！');\
					}\
				}\
			}\
		});\
	}\
	function tab(n){\
		var tabnav='tab'+n;\
		var tabid='tabid'+n;\
		cleardisplay();\
		document.getElementById(tabid).style.display='block';\
		if (n==1) {\
			document.getElementById('share_user').className='menu this share_user';\
			document.getElementById('share_link').className='menu share_link';\
			document.getElementById('share_circle').className='menu share_circle';\
		}\
		else if(n==2) {\
			document.getElementById('share_user').className='menu share_user';\
			document.getElementById('share_link').className='menu this share_link';\
			document.getElementById('share_circle').className='menu share_circle';\
		}\
		else {\
			document.getElementById('share_user').className='menu share_user';\
			document.getElementById('share_link').className='menu share_link';\
			document.getElementById('share_circle').className='menu this share_circle';\
		}\
	}\
	function cleardisplay(){\
		for (i=1;i<4;i++) {\
			var cleartabid='tabid'+i;\
			document.getElementById(cleartabid).style.display='none';\
		}\
	}\
	</script>\
	<div class='file_upload'>\
		<div class='top_nav'>\
			<a id='share_user' href='javascript:tab(1);' class='menu this share_user'>分享给用户</a>\
			<a id='share_link' href='javascript:tab(2);' class='menu share_link'>分享链接</a>\
			<a id='share_circle' href='javascript:tab(3);' class='menu share_circle'>分享到圈子</a>\
			<div style='clear:both'></div>\
		</div>\
		<div id='tabid1' class='tabid' style='display:block; padding:20px 0 0 20px;'>\
			<form class='form-inline'>\
				<div><span>用户名：</span><input type='text' id='username', size='30', class='input-xlarge', placeholder='被分享者的用户名', pattern='^[a-zA-Z][a-zA-Z0-9-_\.]{5,12}$', title='用户名必须由6-15位英文或数字组成，且首字母必须为英文' /></div>\
				<input class='webuploader-pick' type='submit' value='分享' onclick='shareLink(\"userShare\")' />\
			</form>\
			<div style='clear:both'></div>\
		</div>\
		<div id='tabid2' class='tabid' style='display:none; padding:20px 0 0 20px;'>\
			<input class='webuploader-pick' type='submit' value='生成分享链接' onclick='shareLink(\"linkShare\")' />\
			<div style='display:block; padding:30px 0 0 0;' id='show_link'>\
				<p>链接地址: \
					<input type='text' id='link_address' value=''/>\
				</p>\
			</div>\
			<div style='clear:both'></div>\
		</div>\
		<div id='tabid3' class='tabid' style='display:none; padding:20px 0 0 20px;'>\
			<input class='webuploader-pick' type='submit' value='生成分享链接' onclick='shareLink(\"circleShare\")' />\
			<div style='clear:both'></div>\
		</div>\
</div>";

define(function(require, exports) {
    return{
        file_info:file_info,
        path_info:path_info,
        path_info_more:path_info_more,
        file_share:file_share
    }
});