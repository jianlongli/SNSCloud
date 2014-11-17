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
                        	<div class="yhulleft">
                            	<span><input type="button" value="新增用户" class="yhbut1" onclick=" $.alertUrl('/sysmanage/adduser', '　新增用户', 730, 500);" /></span>
                                <span><input type="button" value="导入用户" class="yhbut2" onclick=" $.alertUrl('系统管理-用户管理-导入用户.html', '　导入用户', 730, 400);" /></span>
                                <span><input type="button" value="导出用户" class="yhbut3" /></span>
                            </div>
                        	<div class="yhulright">
                             <input type="text" class="xtrpsw"/>
                             <input type="button"  value="查询" class="XTOk" onMouseOver="this.className='XTUpOk'" onMouseOut="this.className='XTOffOk'" />
                            </div>
                            <div class="clear"></div>
                        </li>
                        <li>
                        	<div class="yqul">
                                <table>
                                    <tr class="yqtr">
                                    	<td><input type="checkbox" class="check" /></td>
                                        <td>用户名</td>
                                        <td>真实姓名</td>
                                        <td>单位</td>
                                        <td>角色</td>
                                        <td>状态</td>
                                        <td>创建时间</td>
                                        <td>操作</td>
                                    </tr>
                                    <?php if(isset($page->items) && is_array($page->items)){?>
                                    <?php foreach($page->items as $user){ ?>
                                    <tr>
                                    	<td><input type="checkbox" class="check" /></td>
                                        <td style="text-align:left"><a href="#"><?php echo $user->username;?></a></td>
                                        <td><?php echo $user->name;?></td>
                                        <td><?php echo $user->company; ?></td>
                                        <td><?php echo $user->role; ?></td>
                                        <td><?php if($user->status == 0){echo '正常';}else{echo '禁止';}?></td>
                                        <td><?php echo date('Y,m,d',$user->created);?></td>
                                        <td>
                                        	 <input type="button" value="编辑"  class="deletBut1" data="<?php echo $user->userid;?>" />
                                             <input type="button" value="删除"  class="deletBut1" data="<?php echo $user->userid;?>" />
                                        </td>
                                    </tr>
									<?php }} ?>
                                </table>
                            </div>
                        </li>
                        <li>
                        	<div class="xtulleft"><input type="button"  value="删除" class="XTOk" onMouseOver="this.className='XTUpOk'" onMouseOut="this.className='XTOffOk'" /></div>
                            <div class="xtulright">
                            	<div class="xtRleft">总共有&nbsp;<span><?php echo $page->total_items;?></span>条</div>
                                <div class="xtRcent">每条记录数&nbsp;<select class="xtrsele"><option></option></select></div>
                                <div class="xtRrighg">
                                    <span><a href="/sysmanage/user" class="inpubolr">首页</a></span>
                                    <span><a href="/sysmanage/user?page=<?= $page->before; ?>" class="inpubolr">上一页</a></span>
                                    <?php echo $page->lists;?>
                                    <span><a href="/sysmanage/user?page=<?= $page->next; ?>" class="inpubolr">下一页</a></span>
                                    <span><a href="/sysmanage/user?page=<?= $page->last; ?>" class="inpubolr">尾页</a></span>
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