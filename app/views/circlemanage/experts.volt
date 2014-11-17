<?php echo $this->tag->javascriptInclude('circlestatic/js/SeekTp.js'); ?>
<table class="expertstable1">
	<tr>
		<td class="tdf" >圈子名称:</td>
		<td colspan="2" align="left"><?php echo $circleName;?></td>
	</tr>
	<tr>
		<td class="tdf" >专家姓名:</td>
		<td colspan="2" align="left"><input type="text" class="inputText" name="expertName" id="expertName" /></td>
	</tr>
	<tr>
		<td class="tdf" >专家单位:</td>
		<td colspan="2" align="left"><input type="text" class="inputText" value="..."/></td>	
	</tr>
	<tr>
		<td class="tdf" >专家简介:</td>
		<td align="left"><textarea rows="6" cols="60"></textarea></td>
		<td><a class="resetqz" id="re_set_admin">设为专家</a></td>	
	</tr>
	
</table>
<h5 style="text-align:left;padding-left:3px;font-size:15px;">专家名单:</h5>
<?php if($expertlists){ ?>
<table class="expertstable cmtable" border="1px" width="98%">
    <tr class="tabletr">
		<td>专家ID</td>
		<td>专家姓名</td>
		<td>初始密码</td>
		<td>操作</td>
    </tr>
    <?php foreach($expertlists as $val){ ?>
    <tr>
		<td> <?php echo $val->userid; ?> </td>
		<td> <?php echo $val->username; ?></td>
		<td> <?php echo $val->password; ?> </td>
		<td>
		    <a href="javascript:;"  style="display:none;" class="memberManage" data-type="edit" data-id="<?php echo $val->id;?>">编辑</a>
		    <a href="javascript:;"  class="memberManage" data-type="del" data-id="<?php echo $val->id;?>">删除</a>
		</td>
    </tr>
    <?php } ?>
    
</table>
<?php }else { ?>
	<p style="margin-top:30px;">暂无匹配数据</p>
<?php }?>

<input type='hidden' id='circle_id' value="<?php echo $circleId;?>" />
<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
			url : '/circle/getAllMemberList/',
			success:function(data){
				if (data.code) {
					var oo=new mSift('oo',20);
					oo.Data = data.data;
					oo.Create(document.getElementById('expertName'));
				}
			}
		});
		
		$('#re_set_admin').click(function(){
			var _expertName = $('#expertName').val();
			if (_expertName) {
				$.ajax({
					url : '/circle/addexpert/',
					type : 'post',
					data : {name: _expertName, circleId: $('#circle_id').val()},
					success:function(data){
						if (data) {
							$.circlemanage._init($('li[class="current"]').data('name'),{id:$('#circle_id').val()});
						}
					}
				});
			}
		});
	});
</script>
