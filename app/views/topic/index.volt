<?php echo $this->tag->javascriptInclude('./circlestatic/js/jquery.min.js'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/_dev/src/explorer/common.js'); ?>
<?php echo $this->tag->stylesheetLink('circlestatic/css/styletcs.css'); ?>

<?php if ($circleInfo) {?>
	<div id="error_div" style="display: none;width: 100%;"></div>
	<form id="addTopicForm" action="/topic/addtopic/" method="post">
		<input type="hidden" name="circleId" value="<?php echo $circleInfo->circleid;?>" />
		<div class="Qx1">
			<div class="Qx11">圈子名称：</div>
		    <div class="Qx12"><?php echo $circleInfo->name;?></div>
		    <div class="clear"></div>
		</div>
		<div class="Qx1">
			<div class="Qx11">讨论主题：</div>
		    <div class="Qx112"><input type="text" name="topicName" class="inputNam1" /></div>
		    <div class="Qx113"><input style="width: 100px;" type="button" id="add_topic_button" value="确定" class="xizbt1"  onMouseOver="this.className='Upxizbt1'" onMouseOut="this.className='Offxizbt1'" /></div>
		    <div class="clear"></div>
		</div>
		<div class="Qx1">
			<div class="Qx11">讨论内容：</div>
		    <div class="Qx12"><textarea class="textarea" name="topicDesc"></textarea></div>
		    <div class="clear"></div>
		</div>
		<div class="Qx1">
			<div class="Qx11">讨论列表：</div>
		    <div class="Qx12"></div>
		    <div class="clear"></div>
		</div>
	</form>
	
	     <div class="cyInfo">
	    	<table class="stable" id="alternatecolor">
	        	<tr class="tabletr">
	            	<td>主题讨论名称</td>
	                <td>发布日期</td>
	                <td>最新回复</td>
	                <td>回复日期</td>
	                <td width="150">操作</td>
	            </tr>
	            <?php if ($page->items) {?>
	            	<?php foreach ($page->items as $value) {?>
			            <tr>
			                <td style="text-align:left;"><a href="#" style=" color:#00F;"><?php echo $value->title;?></a></td>
			                <td><?php echo date('Y.m.d', $value->created);?></td>
			                <td><?php if (isset ($value->lastReplyUserName)) echo $value->lastReplyUserName; else echo '--'; ?></td>
			                <td><?php if (isset ($value->lastReplyTime)) echo $value->lastReplyTime; else echo '--'; ?></td>
			                <td>
			                	<input type="button" value="编辑"  class="deletBut1"/>　
			                	<a href="?delid=<?php echo $value->topicid;?>" style="text-decoration: none;color: gray;">删除</a>
		                	</td>
			            </tr>
	            	<?php }?>
	            <?php } else {?>
	            	<tr>
	            		<td colspan='5'>NO DATA~</td>
	            	</tr>
	            <?php }?>
	            <?php if ($page->total_pages > 1){?>
		            <tr>
		            	<td colspan='5'>
					        <div class="qGirleft5">
					        	<p>
						            <span>共<span><?php echo $page->total_items; ?></span>条数据</span>
						            <a href='?page=<?php echo $page->first;?>' style="text-decoration: none;">首页</a>
						            <a href='?page=<?php echo $page->before;?>' style="text-decoration: none;">上一页</a>
						            <a href='?page=<?php echo $page->next;?>' style="text-decoration: none;">下一页</a>
						            <a href='?page=<?php echo $page->total_pages;?>' style="text-decoration: none;">尾页</a>
						            <span>当前<span><?php echo $page->current;?></span>页</span>
						            <span>共<span><?php echo $page->total_pages;?></span>页</span>
					            </p>
				            </div>
		            	</td>
		            </tr>
	            <?php }?>
	        </table>
	    </div>
	</div>
<?php }?>

<script>
$(document).ready(function(){
	$('#add_topic_button').live('click', function(){
		var _isLock = $(this).attr('lock');
		if (! _isLock) {
			var _topicName = $('input[name="topicName"]').val();
			_topicName = _topicName ? _topicName.trim() : _topicName;
			if (! _topicName) {
				$.common._showMsg ('error_div', '请填写讨论主题~');
			} else {
				$(this).attr('lock', 1).val('提交中~');
				$.common._ajax('addTopicForm', afterSubmit);
			}
		}
	});
});
function afterSubmit (_data) {
	if (_data.code) {
		window.location.reload();
	} else {
		$.common._showMsg ('error_div', '添加失败,请重试~~');
	}
}
</script>