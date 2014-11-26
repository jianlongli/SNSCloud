<ul>
	<li>
    	<div class="yhulleft">
        </div>
    	<div class="yhulleft">
        <input type="text" class="xtrpsw" id="keyWord" value="<?php echo $page->key; ?>" />
		<input type="hidden" class="inputText" id="keyWordH" value="<?php echo $page->key; ?>" />
		<input type="button"  value="查询" class="XTOk Search"/>
        </div>
        <div class="clear"></div>
    </li>
    <li>
    	<div class="yqul">
    	<?php if($page){ ?>
            <table>
                <tr class="yqtr">
                    <td>圈子名称</td>
                    <td>圈主</td>
                    <td>分类</td>
                    <td>单位</td>
                    <td>创建时间</td>
                    <td>审批状态</td>
                    <td>操作</td>
                </tr>
                <?php foreach($page->items as $item){ ?>
                <tr>
                    <td style="text-align:left"><a href="#" onclick="" class="circleDetil" data-id="<?php echo $item->circleid;?>" date-name="<?php echo $item->circlename;?>"><?php echo $item->circlename;?></a></td>
                    <td><?php echo $item->username;?></td>
                    <td>---</td>
                    <td><?php echo $item->companyname;?></td>
                    <td><?php echo date('Y-m-d',$item->time);?></td>
                    <?php $status = $item->status == 0 ? '待审核' : ($item->status == 1 ? '通过' : '禁止');?>
                    <td><?php echo $status;?></td>
                    <td>
                    	<a href="#" data-type="review" data-id="<?php echo $item->id;?>" class="circleManage" >审核</a>
                    	<a href="#" data-type="del" data-id="<?php echo $item->id;?>" class="circleManage" >删除</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
            <?php } ?>
        </div>
    </li>
    <li>
    	<div class="xtulleft"><input type="button"  value="新建" id="create_circle_button" class="XTOk" /></div>
    	<?php if($page->total_pages > 1) { ?>
        <div class="xtulright">
        	<div class="xtRleft">总共有&nbsp;<span><?php echo $page->total_items;?></span>条</div>
            <div class="xtRcent"><div style=" width:70px; height:2px; "></div></div>
            <div class="xtRrighg">
		        <span><a href="#" class="inpubolr syspage" data="/system/circle" >首页</a></span>
		        <span><a href="#" class="inpubolr syspage" data="/system/circle/?page=<?php echo $page->before;?>" >上一页</a></span>
		        <?php echo $page->lists; ?>
		        <span><a href="#" class="inpubolr syspage" data="/system/circle/?page=<?php echo $page->next;?>">下一页</a></span>
		        <span><a href="#" class="inpubolr syspage" data="/system/circle/?page=<?php echo $page->last;?>">尾页</a></span>
            </div>
             <div class="clear"></div>
        </div>
        <?php } ?>
        <div class="clear"></div>
    </li>
</ul>