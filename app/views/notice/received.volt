<?php echo $this->tag->stylesheetLink('./new/css/styletcs.css'); ?>
<?php echo $this->tag->javascriptInclude('./new/js/jquery-1.9.1.js'); ?>
<?php echo $this->tag->javascriptInclude('./new/js/alertInfo.js'); ?>
<?php echo $this->tag->javascriptInclude('./new/js/common.js'); ?>

                  <div class="" >
             {{ form('notice/received/'~circle_id, 'id': 'registerForm', 'onbeforesubmit': 'return false','enctype':'multipart/form-data')}}	
                  	<div class="Qxq">
                    	<div class="Qx11">姓名：</div>
                        <div class="Qx12"><input type="text" class="inputNam" name="name" />&nbsp;<input type="submit" value="查询"  class="xizbts"  onMouseOver="this.className='Upxizbts'" onMouseOut="this.className='Offxizbts'" /></div>
                        <div class="clear"></div>
                    </div>
              </form>
                    <div class="Qxq">
                    	<table class="xztr">
                    		{% for product in page.items %}
   									 {% if loop.first %}
                        	<tr class="trd">
                            	<td width="42"><input type="checkbox" onclick="check_all(this,'member_id[]')"/></td>
                                <td width="210">姓名</td>
                                <td>学校</td>
                            </tr>
                              
                                       {% endif %}
                            <tr>
                            	<td><input type="checkbox" name='member_id[]' value="{{product.getUsers().name}}*{{product.member_id}}" /></td>
                                <td>{{product.getUsers().name}}<input type="hidden" name="member_name[]" value="{{product.getUsers().name}}"/></td>
                                <td>暂无</td>
                            </tr>
                             {% if loop.last %}
                                       
                                            {% endif %}
								{% else %}
  											  No members are recorded
								{% endfor %}

                        </table>
                          
                    {{ link_to("notice/received/"~circle_id, '<i class="icon-fast-backward"></i> 首页', "class": "qxtbut1") }}
                    {{ link_to("notice/received/"~circle_id~"?page=" ~ page.before, '<i class="icon-step-backward"></i> 上一页', "class": "qxtbut1") }}
                    {{ link_to("notice/received/"~circle_id~"?page=" ~ page.next, '<i class="icon-step-forward"></i> 下一页', "class": "qxtbut1") }}
                    {{ link_to("notice/received/"~circle_id~"?page=" ~ page.last, '<i class="icon-fast-forward"></i> 尾页', "class": "qxtbut1") }}
                    <span class="help-inline">{{ page.current }} of {{ page.total_pages }}</span>

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

