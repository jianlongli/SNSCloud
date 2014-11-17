<?php echo $this->tag->javascriptInclude('./circlestatic/js/jquery.min.js'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/lib/artDialog/jquery-artDialog.js?skin=default');?>
<?php echo $this->tag->stylesheetLink('./circlestatic/css/styletcs.css'); ?>
 <div>
    <div class="Qxq">
    	<?php if ($companylist) {?>
	    	<table class="xztr">
	    	<tr class="trd">
            	<td width="42"></td>
                <td width="210">单位名称</td>
            </tr>
	    		<?php foreach ($companylist as $key=>$value) {?>
		            <tr>
		                <td><input type="radio" name="company_name" data-name="<?php echo $value->name;?>" value="<?php echo $value->id;?>" /></td>
		                <td><?php echo $value->name;?></td>
		            </tr>
	    		<?php }?>
	        </table>
    	<?php }?>
    </div>
</div>
<script>
$(document).ready(function(){
	var _cId = art.dialog.data('cId');
	if (_cId) {
		$.each ($('input[name="company_name"]'), function(i, n){
			if ($(this).val() == _cId) {
				$(this).attr('checked','checked');
				return false;
			}
		});
	}
});
</script>