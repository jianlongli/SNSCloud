<?php echo $this->tag->stylesheetLink('./new/css/styletcs.css'); ?>
<?php echo $this->tag->javascriptInclude('./new/js/jquery-1.9.1.js'); ?>
<?php echo $this->tag->javascriptInclude('./new/js/alertInfo.js'); ?>
<?php echo $this->tag->javascriptInclude('./new/js/common.js'); ?>

                  <div class="" >
             <?php echo $this->tag->form(array('notice/received/' . $circle_id, 'id' => 'registerForm', 'onbeforesubmit' => 'return false', 'enctype' => 'multipart/form-data')); ?>	
                  	<div class="Qxq">
                    	<div class="Qx11">姓名：</div>
                        <div class="Qx12"><input type="text" class="inputNam" name="name" />&nbsp;<input type="submit" value="查询"  class="xizbts"  onMouseOver="this.className='Upxizbts'" onMouseOut="this.className='Offxizbts'" /></div>
                        <div class="clear"></div>
                    </div>
              </form>
                    <div class="Qxq">
                    	<table class="xztr">
                    		<?php $v139292661297357608891iterated = false; ?><?php $v139292661297357608891iterator = $page->items; $v139292661297357608891incr = 0; $v139292661297357608891loop = new stdClass(); $v139292661297357608891loop->length = count($v139292661297357608891iterator); $v139292661297357608891loop->index = 1; $v139292661297357608891loop->index0 = 1; $v139292661297357608891loop->revindex = $v139292661297357608891loop->length; $v139292661297357608891loop->revindex0 = $v139292661297357608891loop->length - 1; ?><?php foreach ($v139292661297357608891iterator as $product) { ?><?php $v139292661297357608891loop->first = ($v139292661297357608891incr == 0); $v139292661297357608891loop->index = $v139292661297357608891incr + 1; $v139292661297357608891loop->index0 = $v139292661297357608891incr; $v139292661297357608891loop->revindex = $v139292661297357608891loop->length - $v139292661297357608891incr; $v139292661297357608891loop->revindex0 = $v139292661297357608891loop->length - ($v139292661297357608891incr + 1); $v139292661297357608891loop->last = ($v139292661297357608891incr == ($v139292661297357608891loop->length - 1)); ?><?php $v139292661297357608891iterated = true; ?>
   									 <?php if ($v139292661297357608891loop->first) { ?>
                        	<tr class="trd">
                            	<td width="42"><input type="checkbox" onclick="check_all(this,'member_id[]')"/></td>
                                <td width="210">姓名</td>
                                <td>学校</td>
                            </tr>
                              
                                       <?php } ?>
                            <tr>
                            	<td><input type="checkbox" name='member_id[]' value="<?php echo $product->getUsers()->name; ?>*<?php echo $product->member_id; ?>" /></td>
                                <td><?php echo $product->getUsers()->name; ?><input type="hidden" name="member_name[]" value="<?php echo $product->getUsers()->name; ?>"/></td>
                                <td>暂无</td>
                            </tr>
                             <?php if ($v139292661297357608891loop->last) { ?>
                                       
                                            <?php } ?>
								<?php $v139292661297357608891incr++; } if (!$v139292661297357608891iterated) { ?>
  											  No members are recorded
								<?php } ?>

                        </table>
                          
                    <?php echo $this->tag->linkTo(array('notice/received/' . $circle_id, '<i class="icon-fast-backward"></i> 首页', 'class' => 'qxtbut1')); ?>
                    <?php echo $this->tag->linkTo(array('notice/received/' . $circle_id . '?page=' . $page->before, '<i class="icon-step-backward"></i> 上一页', 'class' => 'qxtbut1')); ?>
                    <?php echo $this->tag->linkTo(array('notice/received/' . $circle_id . '?page=' . $page->next, '<i class="icon-step-forward"></i> 下一页', 'class' => 'qxtbut1')); ?>
                    <?php echo $this->tag->linkTo(array('notice/received/' . $circle_id . '?page=' . $page->last, '<i class="icon-fast-forward"></i> 尾页', 'class' => 'qxtbut1')); ?>
                    <span class="help-inline"><?php echo $page->current; ?> of <?php echo $page->total_pages; ?></span>

                    </div>
                     <div class="Qxq">
                     	<div class="Qx11">　　　　</div>
                        <div class="Qx12">
                            <input type="submit" value="确定" class="Okbutq" onclick="sub_act();window.close();" onMouseOver="this.className='UpOkbutq'" onMouseOut="this.className='OffOkbutq'"  />
                            <input type="submit" value="取消" class="Okbutq1" onclick="window.close();" onMouseOver="this.className='UpOkbutq1'" onMouseOut="this.className='OffOkbutq1'" />
                        </div><br />
                        <div class="clear"></div>
                     </div>
                  </div>
                </div>
                
</div>

