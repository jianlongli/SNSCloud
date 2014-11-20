<?php echo $this->tag->javascriptInclude('circlestatic/js/SeekTp.js'); ?>
<h5 style="text-align:left;padding-left:3px;font-size:15px;">专家名单:</h5>
<?php if($expertlists){ ?>
<table class="expertstable cmtable" border="1px" width="98%">
    <tr class="tabletr">
		<td>专家ID</td>
		<td>专家姓名</td>
    </tr>
    <?php foreach($expertlists as $val){ ?>
    <tr>
		<td> <?php echo $val->userid; ?> </td>
		<td> <?php echo $val->username; ?></td>
    </tr>
    <?php } ?>
    
</table>
<?php }else { ?>
	<p style="margin-top:30px;">暂无匹配数据</p>
<?php }?>

