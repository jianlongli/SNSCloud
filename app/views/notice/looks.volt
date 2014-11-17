<?php echo $this->tag->stylesheetLink('./new/css/styletcs.css'); ?>
<div class="Qx1">
            <table width="700" class="tztable">
                                                                    
								{% for product in page.items %}
   									 {% if loop.first %}
                                        <tr class="tabletr">
                                            <td>通知名称</td>
                                            <td>接收人</td>
                                            <td>是否已读</td>
                                            <td width="200">阅读时间</td>
                                        </tr>
                                        
                                       {% endif %}
  
                                        <tr>
                                            <td>{{product.getNotices().notice_title}}</td>
                                            <td>{{product.getUsers().name}}</td>
                                            <td>{% if product.isread == 0 %}否 {% else %}是{% endif %}</td>
                                            <td>{{product.read_time}}</td>    
                                        </tr>
                                          {% if loop.last %}
                                       
                                            {% endif %}
								{% else %}
  											  No members are recorded
								{% endfor %}
               
                                    </table>
                 <div class="clear"></div>
 </div>
   <div class="Qx12xy">
                    {{ link_to("notice/look/"~notice_id, '<i class="icon-fast-backward"></i> 首页', "class": "qxtbut1") }}
                    {{ link_to("notice/look/"~notice_id~"?page=" ~ page.before, '<i class="icon-step-backward"></i> 上一页', "class": "qxtbut1") }}
                    {{ link_to("notice/look/"~notice_id~"?page=" ~ page.next, '<i class="icon-step-forward"></i> 下一页', "class": "qxtbut1") }}
                    {{ link_to("notice/look/"~notice_id~"?page=" ~ page.last, '<i class="icon-fast-forward"></i> 尾页', "class": "qxtbut1") }}
                    <span class="help-inline">{{ page.current }} of {{ page.total_pages }}</span>
                                    </div>