<?php echo $this->tag->stylesheetLink('./new/css/styletcs.css'); ?>
<script language="javascript">
 function sub_act (act,id) {

  window.location.href="../"+act+"?id="+id;

 }
 </script>
<?php if($manage){ ?>
                 <div class="fbtoz"><?php echo $notices->notice_title; ?></div>
                    <div class="fbtoz">
                    	<ul>
                        	<li>接收人：<span><?php if ($notices->receive_people == 0) { ?>圈子所有人<?php } else { ?> 指定人<?php } ?></span></li>
                            <li>是否回执：<span style="color:#F00;"><?php if ($notices->back == 0) { ?>否<?php } else { ?>是<?php } ?></span></li>
                            <li>发布时间：<span><?php echo $notices->add_time; ?></span></li>
                             <div class="clear"></div>
                        </ul>
                       
                    </div>
                  	<div class="fbtoz"><hr /> </div>
                    <div class="fbtoz"><?php echo $notices->content; ?></div>
                    <div class="fbtoz"><?php if ($notices->notice_fujian != 'no file') { ?>
                    	<div class="Qx11">附件：<span><a href="../down?fujian=<?php echo $notices->notice_fujian; ?>" style="text-decoration:none;"><?php echo $notices->fujian_name; ?></a></span></div>
                       
                       <?php } ?> <div class="clear"></div>
                    </div>
                   
                    <div class="fbtoz">
                    	<div class="Qx11">回执情况：</div>
                        <div class="clear"></div>
                    </div>
                   
                         <div class="cyInfo1">
                        	<table  id="alternatecolor">
                        	<?php $v117703207271387726031iterated = false; ?><?php $v117703207271387726031iterator = $page->items; $v117703207271387726031incr = 0; $v117703207271387726031loop = new stdClass(); $v117703207271387726031loop->length = count($v117703207271387726031iterator); $v117703207271387726031loop->index = 1; $v117703207271387726031loop->index0 = 1; $v117703207271387726031loop->revindex = $v117703207271387726031loop->length; $v117703207271387726031loop->revindex0 = $v117703207271387726031loop->length - 1; ?><?php foreach ($v117703207271387726031iterator as $product) { ?><?php $v117703207271387726031loop->first = ($v117703207271387726031incr == 0); $v117703207271387726031loop->index = $v117703207271387726031incr + 1; $v117703207271387726031loop->index0 = $v117703207271387726031incr; $v117703207271387726031loop->revindex = $v117703207271387726031loop->length - $v117703207271387726031incr; $v117703207271387726031loop->revindex0 = $v117703207271387726031loop->length - ($v117703207271387726031incr + 1); $v117703207271387726031loop->last = ($v117703207271387726031incr == ($v117703207271387726031loop->length - 1)); ?><?php $v117703207271387726031iterated = true; ?>
   									 <?php if ($v117703207271387726031loop->first) { ?>
                                        <tr class="tabletr">
                                            <td>接收人</td>
                                            <td>是否回执</td>
                                            <td>是否阅读</td>
                                            <td>阅读时间</td>
                                            <td>回执内容</td>
                                    		<td>回执附件</td>
                                        </tr>
                                        
                                       <?php } ?>
                            	 <tr>
                                            <td><?php echo $product->getUsers()->name; ?></td>
                                             <td><?php if ($product->back == 0) { ?>否 <?php } else { ?>是<?php } ?></td>
                                            <td><?php if ($product->isread == 0) { ?>否 <?php } else { ?>是<?php } ?></td>
                                            <td><?php echo $product->read_time; ?></td>    
                                            <td><?php echo $product->back_content; ?></td>    
                                            <td><?php echo $product->back_fujianname; ?></td>    
                                        </tr>
                                          <?php if ($v117703207271387726031loop->last) { ?>
                                       
                                            <?php } ?>
								<?php $v117703207271387726031incr++; } if (!$v117703207271387726031iterated) { ?>
  											  No members are recorded
								<?php } ?>
                                
                            </table>
                        </div>
                  <div class="fbtoz">
                        <input type="button" onclick="sub_act('excel','<?php echo $notice_id; ?>')" value="导出Excel"class="quanz" onMouseOver="this.className='Upquanz'" onMouseOut="this.className='Offquanz'" />
                        <input type="button" onclick="sub_act('fujian','<?php echo $notice_id; ?>')" value="导出附件"class="quanz" onMouseOver="this.className='Upquanz'" onMouseOut="this.className='Offquanz'" />　
                     </div>
                     <div class="clear"></div>
                    </div>
<?php }else{ ?>


                 <div class="fbtoz"><?php echo $notices->notice_title; ?></div>
                    <div class="fbtoz">
                    	<ul>
                            <li>接收人：<span><?php if ($notices->receive_people == 0) { ?>圈子所有人<?php } else { ?> 指定人<?php } ?></span></li>
                            <li>是否回执：<span style="color:#F00;"><?php if ($notices->back == 0) { ?>否<?php } else { ?>是<?php } ?></span></li>
                            <li>发布时间：<span><?php echo $notices->add_time; ?></span></li>
                            <div class="clear"></div>
                        </ul>
                       
                    </div>
                    <div class="fbtoz"><hr /> </div>
                    <div class="fbtoz"><?php echo $notices->content; ?></div>
                    <div class="fbtoz"><?php if ($notices->notice_fujian != 'no file') { ?>
                    	<div class="Qx11">附件：<span><a href="../down?fujian=<?php echo $notices->notice_fujian; ?>" style="text-decoration:none;"><?php echo $notices->fujian_name; ?></a></span></div>
                       
                       <?php } ?> <div class="clear"></div>
                    </div>
		</div>

<?php } ?>
