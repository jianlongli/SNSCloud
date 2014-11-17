<?php echo $this->tag->javascriptInclude('./circlestatic/js/jquery.min.js'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/lib/artDialog/jquery-artDialog.js?skin=default');?>
<?php echo $this->tag->stylesheetLink('./circlestatic/css/styletcs.css'); ?>
 <div>
    <div class="Qxq">
    	<?php if ($user) {?>
	    	<table class="xztr">
	    	<tr class="trd">
            	<td width="42"><input type="checkbox" id='check_all' /></td>
                <td width="210">姓名</td>
            </tr>
	    		<?php foreach ($user as $key=>$value) {?>
		            <tr>
		                <td><input type="checkbox" data-name="<?php echo $value->username;?>" value="<?php echo $value->userid;?>" /></td>
		                <td><?php echo $value->username;?></td>
		            </tr>
	    		<?php }?>
	        </table>
    	<?php }?>
    </div>
</div>

<script>
$(document).ready(function(){
	var _memberId = art.dialog.data('memberId');
	if (_memberId) {
		var _IdArr = _memberId.split(',');
		$.each($('input[data-name]'), function(i, n){
			if ($.inArray($(this).val(),_IdArr) >= 0) {
				$(this).attr('checked', 'checked');
			}
		});
	}
	var _count = $('input[data-name]').size();
	var _checked_count = $('input[data-name]:checked').size();
	if (_checked_count == _count) {
		$('#check_all').attr('checked', 'checked');
	}
	
	$('#check_all').live('click', function(){
		if ($(this).attr('checked') === 'checked') {
			$('input[data-name]').attr('checked', 'checked');
		} else {
			$('input[data-name]').removeAttr('checked');
		}
	});
	$('input[data-name]').live('click', function(){
		if (_checked_count == _count) {
			$('#check_all').attr('checked', 'checked');
		} else {
			$('#check_all').removeAttr('checked');
		}
	});
});
</script>