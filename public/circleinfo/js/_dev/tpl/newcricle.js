define(function(require, exports) {
    return{
        html:"\
        <div class='file_upload'>\
        	<div>\
        		<div style='display:block; padding:30px 0 0 0;' id='circleName'>\
        			<label class='control-label' for='username'>圈子名称: </label>\
					<input id='username' name='username' type='text' placeholder='username' pattern='^[a-zA-Z][a-zA-Z0-9-_\.]{5,12}$' title='用户名必须由6-15位英文或数字组成，且首字母必须为英文' required/>\
                <p class='help-block'>-- 圈子名称中不能保护特殊字符</p>\
				</div>\
	        	<input class='webuploader-pick' type='submit' value='创建' onclick='createCircle()' />\
				<div style='clear:both'></div>\
        	</div>\
        </div>\
        <script language='javascript'>\
		function createCircle() {\
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
		</script>"
    }
});
