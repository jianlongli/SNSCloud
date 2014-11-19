<ul>
	<li>
    	<div class="yqul">
         <span>单位名称:</span>
         <input type="hidden" class="inputText" id="keyWordH" value="<?php echo $page->key; ?>" />
          <span style="margin-left:20px;">区域:</span>
          <select class="xtrsele" id="regionalOption" ><?php echo $page->regionalOption;?></select>
          <input type="hidden" id="regionalOptionH" name="regionalOptionH" value="<?php echo $page->regional;?>" />
          <input type="text" class="xtrpsw" id="keyWord" value="<?php echo $page->key; ?>" />
		  <input type="button"  value="查询" class="XTOk Search"/>
        </div>
        <div class="clear"></div>
    </li>
    <li>
    	<div class="yqul">
    	<?php if($page){ ?>
            <table>
                <tr class="yqtr">
                	<td><input type="checkbox" class="check" id="chooseAll"/></td>
                    <td>单位名称</td>
                    <td>所属区域</td>
                    <td>电话</td>
                    <td>创建时间</td>
                    <td>人员数量</td>
                    <td>操作</td>
                </tr>
                <?php foreach($page->items as $item){ ?>
                <tr>
                	<td><input type="checkbox" class="check" name="chkItem[]"  value="<?php echo $item->id;?>" /></td>
                    <td style="text-align:left"><a href="#"> <?php echo $item->companyname;?> </a></td>
                    <td><?php echo $item->regionalname;?></td>
                    <td><?php echo $item->phone;?></td>
                    <td><?php echo date('Y-m-d',$item->time);?></td>
                    <td><?php echo $item->num;?></td>
                    <td>
                    	<a href="#" data-id="<?php echo $item->id;?>">编辑</a>
                    	<a href="#" class="Delopration"  data-id="<?php echo $item->id;?>">删除</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
            <?php } ?>
        </div>
    </li>
    <li>
    	<div class="xtulleft"><input type="button"  value="新建" class="XTOk" onMouseOver="this.className='XTUpOk'" onMouseOut="this.className='XTOffOk'" onclick=" $.alertUrl('系统管理-单位管理-新建单位.html', '　新建单位', 500, 280);"/></div>
    	<div class="xtulleft"><input type="button"  value="删除" class="XTOk Delopration" /></div>
    	<?php if($page->total_pages > 1) { ?>
        <div class="xtulright">
        	<div class="xtRleft">总共有&nbsp;<span><?php echo $page->total_items;?></span>条</div>
            <div class="xtRcent"><div style=" width:70px; height:2px; "></div></div>
            <div class="xtRrighg">
		        <span><a href="#" class="inpubolr syspage" data="/system/company" >首页</a></span>
		        <span><a href="#" class="inpubolr syspage" data="/system/company/?page=<?php echo $page->before;?>" >上一页</a></span>
		        <?php echo $page->lists; ?>
		        <span><a href="#" class="inpubolr syspage" data="/system/company/?page=<?php echo $page->next;?>">下一页</a></span>
		        <span><a href="#" class="inpubolr syspage" data="/system/company/?page=<?php echo $page->last;?>">尾页</a></span>
            </div>
             <div class="clear"></div>
        </div>
        <?php } ?>
        <div class="clear"></div>
    </li>
</ul>