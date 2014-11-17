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
                                        <td>区域名称</td>
                                        <td>区域内单位数量</td>
                                        <td>区域内用户数量</td>
                                        <td>区域管理员</td>
                                        <td>操作</td>
                                    </tr>
                                    <?php if(isset($page->items) && is_array($page->items)){?>
                                    <?php foreach($page->items as $area){ ?>
                                    <tr>
                                        <td style="text-align:left"><a href="#"><?php echo $area->name;?></a></td>
                                        <td>6</td>
                                        <td>48</td>
                                        <td>12</td>
                                        <td>
                                        	 <input type="button" value="指定管理员"   class="deletBut1"  onclick=" $.alertUrl('系统管理-区域管理-指定区域管理员.html', '　指定区域管理员', 650, 400);"/>
                                        	 <input type="button" value="修改"  class="deletBut1" onclick=" $.alertUrl('系统管理-区域管理-修改区域信息.html', '　修改区域信息', 650, 400);"/>
                                             <input type="button" value="删除"  class="deletBut1"/>
                                        </td>
                                    </tr>
                                    <?php }}?>
                                </table>
                            </div>
                        </li>
                        <li>
                        	<div class="xtulleft"><input type="button"  value="新建" class="XTOk" onMouseOver="this.className='XTUpOk'" onMouseOut="this.className='XTOffOk'" onclick=" $.alertUrl('系统管理-区域管理-添加区域信息.html', '　添加区域信息', 650, 400);"/></div>	
                            <div class="xtulright">
                                <div class="xtRcent"><div style=" width:280px; _width:250px; height:2px; "></div></div>
                                <div class="xtRrighg">
                                    <span><a href="/sysmanage/area" class="inpubolr">首页</a></span>
                                    <span><a href="/sysmanage/area?page=<?= $page->before; ?>" class="inpubolr">上一页</a></span>
                                    <?php echo $page->lists;?>
                                    <span><a href="/sysmanage/area?page=<?= $page->next; ?>" class="inpubolr">下一页</a></span>
                                    <span><a href="/sysmanage/area?page=<?= $page->last; ?>" class="inpubolr">尾页</a></span>
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