            <div  class="clear"></div> 
            <div style="height:10px;"></div>          
            <div class="GIRightXT">
              <div class="XTglInfo">
              	<!--Public tag start-->
              	<div class="XTglInfoul"><?php $this->partial("sysmanage/tag") ?></div>
              	<!--Public tag start-->
                <div class="XTglInfodiv">
                	<ul>
                    	<li>
                        	<div class="yqul">
                             <span>单位名称:</span>
                             <input type="text" class="xtrpsw1"/>
                              <span style="margin-left:20px;">区域:</span>
                              <select class="xtrsele"><option></option></select>
                             <input type="button"  value="查询" class="XTOk" onMouseOver="this.className='XTUpOk'" onMouseOut="this.className='XTOffOk'" />
                            </div>
                            <div class="clear"></div>
                        </li>
                        <li>
                        	<div class="yqul">
                                <table>
                                    <tr class="yqtr">
                                    	<td><input type="checkbox" class="check" /></td>
                                        <td>单位名称</td>
                                        <td>所属区域</td>
                                        <td>电话</td>
                                        <td>创建时间</td>
                                        <td>人员数量</td>
                                        <td>操作</td>
                                    </tr>
                                    <?php if(isset($page->items) && is_array($page->items)){?>
                                    <?php foreach($page->items as $companys){ ?>
                                    <tr>
                                    	<td><input type="checkbox" class="check" /></td>
                                        <td style="text-align:left"><a href="#"><?php echo $companys->name;?></a></td>
                                        <td><?php echo $companys->area;?></td>
                                        <td><?php echo $companys->phone;?></td>
                                        <td><?php echo date('Y.m.d',$companys->createtime);?></td>
                                        <td>2</td>
                                        <td>
                                        	 <input type="button" value="编辑"  class="deletBut1"/>
                                             <input type="button" value="删除"  class="deletBut1"/>
                                        </td>
                                    </tr>
               						<?php }} ?>
                                </table>
                            </div>
                        </li>
                        <li>
                        	<div class="xtulleft"><input type="button"  value="新建" class="XTOk" onMouseOver="this.className='XTUpOk'" onMouseOut="this.className='XTOffOk'" onclick=" $.alertUrl('/sysmanage/addcompany', '　新建单位', 500, 280);"/></div>
                        	<div class="xtulleft"><input type="button"  value="删除" class="XTOk" onMouseOver="this.className='XTUpOk'" onMouseOut="this.className='XTOffOk'" /></div>
                            <div class="xtulright">
                            	<div class="xtRleft">总共有&nbsp;<span><?php echo $page->total_items;?></span>条</div>
                                <div class="xtRcent"><div style=" width:70px; height:2px; "></div></div>
                                <div class="xtRrighg">
                                    <span><a href="/sysmanage/company" class="inpubolr">首页</a></span>
                                    <span><a href="/sysmanage/company?page=<?= $page->before; ?>" class="inpubolr">上一页</a></span>
                                    <?php echo $page->lists;?>
                                    <span><a href="/sysmanage/company?page=<?= $page->next; ?>" class="inpubolr">下一页</a></span>
                                    <span><a href="/sysmanage/company?page=<?= $page->last; ?>" class="inpubolr">尾页</a></span>
                                </div>
                                 <div class="clear"></div>
                            </div>
                            <div class="clear"></div>
                        </li>
                    </ul>
                </div>
                 <div class="clear"></div>
              </div>
            </div>
          <div class="GIRight4"></div>