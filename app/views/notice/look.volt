<?php echo $this->tag->stylesheetLink('./new/css/styletcs.css'); ?>
<script language="javascript">
 function sub_act (act,id) {

  window.location.href="../"+act+"?id="+id;

 }
 </script>
                 	<div class="fbtoz">{{notices.notice_title}}</div>
                    <div class="fbtoz">
                    	<ul>
                        	<li>接收人：<span>{% if notices.receive_people == 0%}圈子所有人{% else %} 指定人{% endif %}</span></li>
                            <li>是否回执：<span style="color:#F00;">{% if notices.back == 0%}否{% else %}是{% endif %}</span></li>
                            <li>发布时间：<span>{{notices.add_time}}</span></li>
                             <div class="clear"></div>
                        </ul>
                       
                    </div>
                  	<div class="fbtoz"><hr /> </div>
                    <div class="fbtoz">{{notices.content}}</div>
                    <div class="fbtoz">{% if notices.notice_fujian !="no file"%}
                    	<div class="Qx11">附件：<span><a href="../down?fujian={{notices.notice_fujian}}" style="text-decoration:none;">{{notices.fujian_name}}</a></span></div>
                       
                       {% endif %} <div class="clear"></div>
                    </div>
                   
                    <div class="fbtoz">
                    	<div class="Qx11">回执情况：</div>
                        <div class="clear"></div>
                    </div>
                   
                         <div class="cyInfo1">
                        	<table  id="alternatecolor">
                        	{% for product in page.items %}
   									 {% if loop.first %}
                                        <tr class="tabletr">
                                            <td>接收人</td>
                                            <td>是否回执</td>
                                            <td>是否阅读</td>
                                            <td>阅读时间</td>
                                            <td>回执内容</td>
                                    		<td>回执附件</td>
                                        </tr>
                                        
                                       {% endif %}
                            	 <tr>
                                            <td>{{product.getUsers().name}}</td>
                                             <td>{% if product.back == 0 %}否 {% else %}是{% endif %}</td>
                                            <td>{% if product.isread == 0 %}否 {% else %}是{% endif %}</td>
                                            <td>{{product.read_time}}</td>    
                                            <td>{{product.back_content}}</td>    
                                            <td>{{product.back_fujianname}}</td>    
                                        </tr>
                                          {% if loop.last %}
                                       
                                            {% endif %}
								{% else %}
  											  No members are recorded
								{% endfor %}
                                
                            </table>
                        </div>
                  <div class="fbtoz">
                        <input type="button" onclick="sub_act('excel','{{notice_id}}')" value="导出Excel"class="quanz" onMouseOver="this.className='Upquanz'" onMouseOut="this.className='Offquanz'" />
                        <input type="button" onclick="sub_act('fujian','{{notice_id}}')" value="导出附件"class="quanz" onMouseOver="this.className='Upquanz'" onMouseOut="this.className='Offquanz'" />　
                     </div>
                     <div class="clear"></div>
                    </div>
