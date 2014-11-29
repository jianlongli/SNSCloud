<?php echo $this->tag->javascriptInclude('./circlestatic/js/swfupload.js'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/swfupload.queue.js'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/fileprogress.js'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/handlers.js'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/_dev/src/explorer/common.js'); ?>

<?php if(isset($circleInfo) && count($circleInfo) > 0 && is_array($circleInfo)){ ?>
<form id="circleUpdateForm" action="/circlemanage/circleupdate" method="POST">
<table class="circleinfo">
	<input type="hidden" name="circle_id" id="circle_id" value="<?php echo $circleInfo['circleId'];?>" />
	<tr>
		<td align="right" class="tdf">圈子名称: </td>
		<td align="left"><input class="inputText" type="text" name="circlename" id="circlename" value="<?php echo $circleInfo['circlename']; ?>"/></td>
		<td></td>
	</tr>
	<tr>
		<td align="right" class="tdf">圈子介绍:</td>
		<td align="left" colspan="2"><textarea  rows="6" cols="60" name="desc" id="desc" ><?php echo $circleInfo['desc']; ?></textarea></td>
	</tr>
	<tr>
		<td align="right" class="tdf">圈子分类:</td>
		<td align="left">
			<?php if($categoryList) {?>
				<select name="cagegory">
					<?php foreach($categoryList as $value){?>
						<option value="<?php echo $value->Id;?>" <?php if ($circleInfo['categoryId'] == $value->Id){echo "selected";}?> ><?php echo $value->name;?></option>
					<?php }?>
				</select>
			<?php }?>
		</td>
	</tr>	
	<tr>
		<td align="right" class="tdf">圈子LOGO:</td>
		<td align="left" colspan='2'>
		     <div style="width: 60px;float: left;">
				<div id='spanButtonPlaceHolder'></div>
			</div>
			<input id="btnCancel" type="button" value="取消上传" onclick="swfu.cancelQueue();" disabled="disabled" style="font-size: 8pt; height: 29px;margin-left: 50px;" />
			<div class="fieldset flash" id="fsUploadProgress" style="display: none;"></div>
			<input type="hidden" name="qz_logo" value=""/>
		</td>
	</tr>
	<tr>
		<td></td>
		<td align="left" colspan='2'><img id="logoImg" src="<?php echo $circleInfo['logo'];?>" width="80px" height="80px" /></td>
	</tr>
	<tr>
		<td align="right" class="tdf">圈主:</td>
		<input type="hidden" id="quanzhuId" name="quanzhuId" value="<?php echo $circleInfo['quanzhuId'];?>" />
		<td align="left"><input class="inputText" id='quanzhunameid' name="quanzhuname" type='text' value="<?php echo $circleInfo['member2']; ?>"/></td>
		<td class="dn"><a class="resetqz" id="choose_qz_quanzhu_button">选择</a></td>
	</tr>
	<tr>
		<td align="right" class="tdf">圈子管理员:</td>
		<td align="left">
			<input type="text" class="inputText"  name="qz_admin" value="<?php echo $circleInfo['member1']; ?>" readonly />　　
            <input type='hidden' name='qz_admin_id' value="<?php echo $circleInfo['member1_id'];?>" />
		</td>
		<td><a class="resetqz" id='check_qz_admin_button' >选择</a></td>
	</tr>
	<tr>
		<td align="right" class="tdf">评论开关:</td>
		<td colspan="2">
			<button class="mwui-switch-btn">
					<span change="OFF">ON</span>
					<input type="hidden" name="comment_flag" value="1" />
			</button>
		</td>
	</tr>
	<tr>
		<td align="right" class="tdf">讨论开关:</td>
		<td colspan="2">
			<button class="mwui-switch-btn">
					<span change="OFF">ON</span>
					<input type="hidden" name="topic_flag" value="1" />
				</button>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="left"><center><input type="submit" class="submitBtn"  id="submitBtn" value="确定"/></center></td>
	</tr>
</table>
</form>
<?php }else{ ?>
	<p>No data</p>
<?php } ?>


<script>
$(document).ready(function(){
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
</script>