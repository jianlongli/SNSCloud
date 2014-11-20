<table class="circlemembertable1">
	<tr>
		<td class="tdf">教育即测试圈</td>
		<td>
			<input type="text" class="inputText" id="keyWord" value="<?php echo $page->key; ?>" />
			<input type="hidden" class="inputText" id="keyWordH" value="<?php echo $page->key; ?>" />
		</td>
		<td><input type="button"  value="搜索" class="XTOk memberSearch resetqz"  /></td>
	<tr>
</table>
<?php if($page){ ?>
<table class="circlemembertable cmtable" border="1px" width="98%">
    <tr class="tabletr">
    	<td>序号</td>
		<td>账号</td>
		<td>单位</td>
    </tr>
    
    
    <?php foreach($page->items as $item){ ?>
    <tr>
    	<td> <?php echo $item->userid; ?> </td>
		<td> <?php echo $item->username; ?> 
			<?php if($item->type == 1) {?>
			<span style="color:red;">---圈子管理员<span>
			<?php } ?>
			</td>
		<td>----</td>
    </tr>
    <?php } ?>
</table>

<?php if($page->total_pages > 1) { ?>
<div class="xtulright">
	<div class="xtRcent"><div style=" width:370px;_width:300px; height:2px;"></div></div>
    <div class="xtRrighg">
    	<span><a href="javascript:;" ><?php echo $page->total_items;?></a></span>
        <span><a href="#" class="inpubolr syspage" data="/info/member" >首页</a></span>
        <span><a href="#" class="inpubolr syspage" data="/info/member/?page=<?php echo $page->before;?>" >上一页</a></span>
        <?php echo $page->lists; ?>
        <span><a href="#" class="inpubolr syspage" data="/info/member/?page=<?php echo $page->next;?>">下一页</a></span>
        <span><a href="#" class="inpubolr syspage" data="/info/member/?page=<?php echo $page->last;?>">尾页</a></span>
    </div>
     <div class="clear"></div>
</div>
<?php } ?>
<?php }else{ ?>
<p style="margin-top:30px;">暂无匹配数据</p>
<?php } ?>


