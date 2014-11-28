<?php echo $this->tag->stylesheetLink('./circlestatic/css/styletcs.css'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/swfupload.js'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/swfupload.queue.js'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/fileprogress.js'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/handlers.js'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/jquery.min.js'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/_dev/src/explorer/common.js'); ?>
<div id="error_div" style="display: none;width: 100%;"></div>
<div class="" ><form id='apply_form' action="/circle/newcircle" method="post">
  	<div class="Qx1">
    	<div class="Qx11">圈子名称：</div>
        <div class="Qx12"><input type="text" class="inputNam" name="qz_name" /></div>
        <div class="clear"></div>
    </div>
    <div class="Qx1">
        <div class="Qx11">圈子介绍：</div>
        <div class="Qx12"><textarea class="textarea" name="qz_desc"></textarea></div>
        <div class="clear"></div>
    </div>
    <div class="Qx1">
        <div class="Qx11">圈子LOGO：</div>
        <div class="Qx13">
        	<div style="width: 60px;float: left;">
				<div id='spanButtonPlaceHolder'></div>
			</div>
        	<input id="btnCancel" type="button" value="取消上传" onclick="swfu.cancelQueue();" disabled="disabled" style="font-size: 8pt; height: 29px;margin-left: 50px;" />
			<div class="fieldset flash" id="fsUploadProgress" style="display: none;"></div>
        	<input type="hidden" name="qz_logo" />
        	<div class="Qx12" style="margin-top: 10px;"><img id="logoImg" src="" width="150" height="150" /></div><br />
        </div>
        <div class="clear"></div>
     </div>
     <div class="Qx1">
        <div class="Qx11">圈主：</div>
        <div class="Qx12">
            <input type="text" class="inputNam" readonly value="<?php echo $userName;?>" />　　
        </div>
        <div class="clear"></div>
     </div>
     <div class="Qx1">
        <div class="Qx11">圈子管理员：</div>
        <div class="Qx14">
            <input type="text" class="inputNam"  name="qz_admin" readonly />　　
            <input type='hidden' name='qz_admin_id' />
            <input type="button" value="选择" class="quanz" onMouseOver="this.className='Upquanz'" onMouseOut="this.className='Offquanz'" id='check_qz_admin_button' />
        </div>
        <div class="clear"></div>
     </div>
     <div class="Qx1">
        <div class="Qx11">圈子成员：</div>
        <div class="Qx14">
        	<input type="text" class="inputNam" name="qz_member" readonly />　　
        	<input type='hidden' name='qz_member_id' />
            <input type="button" value="选择" class="quanz" onMouseOver="this.className='Upquanz'" onMouseOut="this.className='Offquanz'" id='check_qz_member_button' />
        </div>
        <div class="clear"></div>
     </div>
     
     <div class="Qx1">
        <div class="Qx11">所在单位：</div>
        <div class="Qx14">
        	<input type="text" class="inputNam" name="qz_company" readonly />　　
        	<input type='hidden' name='qz_company_id' />
            <input type="button" value="选择" class="quanz" onMouseOver="this.className='Upquanz'" onMouseOut="this.className='Offquanz'" id='check_qz_company_button' />
        </div>
        <div class="clear"></div>
     </div>
     
     <?php if(isset($goryList)){?>
	     <div class="Qx1">
	        <div class="Qx11">分类：</div>
	        <div class="Qx14">
	        	<select style="width: 200px;" name="circle_category_id">
	        		<?php foreach($goryList as $key=>$value) {?>
	        			<option value="<?php echo $key;?>"><?php echo $value;?></option>
	        		<?php }?>
	        	</select>
	        </div>
	        <div class="clear"></div>
	     </div>
     <?php }?>
     
     <div class="Qx1">
        <div class="Qx11">评论开关：</div>
        <div class="Qx14">
        	<button class="mwui-switch-btn"><span change="OFF">ON</span><input type="hidden" name="comment_flag" value="1" /></button>
        </div>
        <div class="clear"></div>
    </div>
    <div class="Qx1">
        <div class="Qx11">讨论开关：</div>
        <div class="Qx14">
        	<button class="mwui-switch-btn"><span change="OFF">ON</span><input type="hidden" name="topic_flag" value="1" /></button>
        </div>
        <div class="clear"></div>
    </div>
    </form>
  </div>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/lib/artDialog/jquery-artDialog.js?skin=default');?>
<script type="text/javascript">
    $(function() { 
    	$('#check_qz_company_button').live('click', function(){
    		var _cId = $('input[name="qz_company_id"]').val();
    		_cId = _cId ? _cId : 0;
    		art.dialog.data('cId', _cId);
    		art.dialog.open ('/circle/getcompanylist/', {
				id : 'get_company_list_div',
				fixed : true,
				title : '单位列表',
				lock : true,
				height : '580px',
				width : 'auto',
				ok:function() {
					var _checked_company =this.iframe.contentWindow.$("input[name='company_name']:checked");
					var _company_id = _checked_company.val();
					var _company_name = _checked_company.attr('data-name');
					$('input[name="qz_company"]').val(_company_name);
					$('input[name="qz_company_id"]').val(_company_id);
				},
				cancel: true
			});
    	});
    	$('#check_qz_member_button').live('click', function(){
    		var _memberId = $('input[name="qz_member_id"]').val();
    		_memberId = _memberId ? _memberId : '';
    		art.dialog.data('memberId', _memberId);
    		art.dialog.open ('/circle/getmemberlist/?id=' + $('input[name="qz_admin_id"]').val(), {
				id : 'get_member_list_div',
				fixed : true,
				title : '圈子成员',
				lock : true,
				height : '580px',
				width : 'auto',
				ok:function() {
					var qz_member  = qz_member_id = '';
					$.each(this.iframe.contentWindow.$("input[data-name]:checked"), function(i, n){
						var _name = $(n).attr('data-name');
						var _id = $(n).val();
						qz_member += _name + ',';
						qz_member_id += _id + ',';
					});
					qz_member = qz_member ? qz_member.substring(0,qz_member.length-1) : '';
					qz_member_id = qz_member_id ? qz_member_id.substring(0,qz_member_id.length-1) : '';
					$('input[name="qz_member"]').val(qz_member);
					$('input[name="qz_member_id"]').val(qz_member_id);
				},
				cancel: true
			});
		});
    	$('#check_qz_admin_button').live('click', function(){
    		var _adminId = $('input[name="qz_admin_id"]').val();
    		_adminId = _adminId ? _adminId : '';
    		art.dialog.data('memberId', _adminId);
    		art.dialog.open ('/circle/getmemberlist/?id=' + $('input[name="qz_member_id"]').val(), {
				id : 'get_member_list_div',
				fixed : true,
				title : '圈子管理员',
				lock : true,
				height : '580px',
				width : 'auto',
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
    	$.common._swfUpload(uploadSuccess, queueComplete);
        $('.mwui-switch-btn').each(function() {
            $(this).bind("click", function() { 
                var btn = $(this).find("span");
                var change = btn.attr("change");
                btn.toggleClass('off'); 
 
                if(btn.attr("class") == 'off') { 
                    $(this).find("input").val("0");
                    btn.attr("change", btn.html()); 
                    btn.html(change);
                } else { 
                    $(this).find("input").val("1");
                    btn.attr("change", btn.html()); 
                    btn.html(change);
                }  
 
                return false;
            });
        });
    });
    function queueComplete (){}
	function uploadSuccess ( _file, _data) {
		_data = eval ('(' + _data+ ')');
		$('#logoImg').attr('src', _data.img);
		$('input[name="qz_logo"]').val(_data.imgName);
	}
	function afterSubmit(_data){
		$.common._showMsg ('error_div', '申请成功，请耐心等待审核~');
		setTimeout(function(){
			parent.$.circle._get_all_circle ( 1, parent.place_circle_list );
			parent.$('a[class="aui_close"]').click();
		}, 1500);
	}
</script> 