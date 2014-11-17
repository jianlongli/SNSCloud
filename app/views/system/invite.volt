<?php echo $this->tag->javascriptInclude('./eduis/js/jquery.min.js'); ?>
<script src="./circlestatic/js/_dev/src/explorer/system.js" type="text/javascript"></script>
<script src="./circlestatic/js/_dev/src/explorer/common.js" type="text/javascript"></script>
<style>
	.c_red{color:red;}
	.c_green{color:green;}
</style>
<ul>
	<li>
    	<div class="yqul">
        <input type="text" class="xtrpsw" id="keyWord" value="<?php echo $page->key; ?>" />
		<input type="hidden" class="inputText" id="keyWordH" value="<?php echo $page->key; ?>" />
		<input type="button"  value="查询" class="XTOk inviteSearch"/>
        </div>
    </li>
    <li>
    	<div class="yqul">
    	  	<?php if($page){ ?>
            <table>
                <tr class="yqtr">
                    <td>圈子名称</td>
                    <td>分类</td>
                    <td>圈主</td>
                    <td>邀请时间</td>
                    <td>操作</td>
                </tr>
              
                <?php foreach($page->items as $item){ ?>
                <tr>
                	<td style="text-align:left;"><a href="#" onclick=" $.alertUrl('系统管理-圈子邀请-圈子介绍页面.html', '　圈子介绍', 600, 400);"><?php echo $item->circlename;?></a></td>
                    <td> <?php echo $item->id; ?>  </td>
                    <td> <?php echo $item->username; ?> </td>
                    <td> <?php echo date('Y-m-d',$item->time);?></td>
                    <?php $status = $item->status == 1 ? '已加入' : '已拒绝';?>
                    <?php $_class = $item->status == 1 ? 'class="c_green"' : 'class="c_red"';?>
                    <td><a href="#" <?php echo $_class;?> ><?php echo $status;?></a></td>
                </tr>
                <?php } ?>
            </table>
 	        <?php } ?>
        </div>
    </li>
     <li>
     	<?php if($page->total_pages > 1) { ?>
        <div class="xtulright">
        	<div class="xtRcent"><div style=" width:370px;_width:300px; height:2px;"></div></div>
		    <div class="xtRrighg">
		    	<span><a href="javascript:;" ><?php echo $page->total_items;?></a></span>
		        <span><a href="#" class="inpubolr syspage" data="/system/invite" >首页</a></span>
		        <span><a href="#" class="inpubolr syspage" data="/system/invite/?page=<?php echo $page->before;?>" >上一页</a></span>
		        <?php echo $page->lists; ?>
		        <span><a href="#" class="inpubolr syspage" data="/system/invite/?page=<?php echo $page->next;?>">下一页</a></span>
		        <span><a href="#" class="inpubolr syspage" data="/system/invite/?page=<?php echo $page->last;?>">尾页</a></span>
		    </div>
             <div class="clear"></div>
        </div>
        <?php } ?>
        <div class="clear"></div>
    </li>
</ul>

<script>

$(function(){
	    /*Page*/
		$(".syspage").live('click',function (){
			_param = {};
			_url = $(this).attr("data");
			_key = $("#keyWord").val();
			if(_key.length > 0 )
				_param.key = _key;
			$.system._getData( _url , 'invite',_param);
		});
		
		/*Member search*/
		$(".inviteSearch").live('click',function(){
			var _key = $("#keyWord").val();
			_param = {};
			if(_key.length > 0 )
				_param.key = _key;
			_url = '/system/invite';
			$.system._getData( _url , 'invite' , _param );
		});
});

</script>