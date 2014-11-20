<?php if(isset($circleInfo) && count($circleInfo) > 0 && is_array($circleInfo)){ ?>
<form id="circleUpdateForm" action="/circlemanage/circleupdate" method="POST">
<table class="circleinfo">
	<input type="hidden" name="circle_id" id="circle_id" value="<?php echo $circleInfo['circleId'];?>" />
	<tr>
		<td align="right" class="tdf">圈子名称: </td>
		<td align="left"><?php echo $circleInfo['circlename']; ?></td>
		<td></td>
	</tr>
	<tr>
		<td align="right" class="tdf">圈子介绍:</td>
		<td align="left" colspan="2"><?php echo $circleInfo['desc']; ?></td>
	</tr>	
	<tr>
		<td align="right" class="tdf">圈子LOGO:</td>
		<td align="left" colspan='2'>
		</td>
	</tr>
	<tr>
		<td></td>
		<td align="left" colspan='2'><img id="logoImg" src="<?php echo $circleInfo['logo'];?>" width="80px" height="80px" /></td>
	</tr>
	<tr>
		<td align="right" class="tdf">圈主:</td>
		<td align="left"><?php echo $circleInfo['member2']; ?></td>
	</tr>
	<tr>
		<td align="right" class="tdf">圈子管理员:</td>
		<td align="left" colspan='2'>
			<?php echo $circleInfo['member1']; ?>　　
		</td>
	</tr>
</table>
</form>
<?php }else{ ?>
	<p>No data</p>
<?php } ?>

