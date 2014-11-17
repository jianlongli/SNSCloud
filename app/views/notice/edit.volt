<?php echo $this->tag->stylesheetLink('./new/css/styletcs.css'); ?>
<?php echo $this->tag->javascriptInclude('./new/js/jquery-1.9.1.js'); ?>
<?php echo $this->tag->javascriptInclude('./new/js/alertInfo.js'); ?>
<script language="javascript">
 var child;
 function onClick (id) {

  window.open(id,"选择接收人","height=600, width=600, top=100,left=300,toolbar =no, menubar=no, scrollbars=yes, resizable=no, location=no, status=no");
 
 }
 function setData (name) {

  if(document.getElementById('receive_people').value!=""){
    document.getElementById('receive_people').value+=","+name;
  }else{
   document.getElementById('receive_people').value=name;
  }
 }
</script>
{{ form('notice/save/' ~ notice_id, 'id': 'registerForm', 'onbeforesubmit': 'return false','enctype':'multipart/form-data') }}	                
                                <div class="Qx1">
                                    <div class="Qx11">通知名称：</div><input type="hidden" name="notice_id" value="{{notice_id}}">
                                    <input type="hidden" name="circle_id" value="{{circle_id}}">
                                    <div class="Qx12"><input type="text" class="inputNam" id="notice_title" name="notice_title" placeholder="标题" value="{{notice.notice_title}}" required /></div>
                                    <div class="clear"></div>
                                </div>
                                <div class="Qx1">
                                    <div class="Qx11">接收人：</div>
                                    <div class="Qx12">
                                    	<input type="radio" name="receive" {% if notice.receive_people == 0 %} checked {% endif %} value="0" />圈内所有人　
                                        <input type="radio" name="receive" {% if notice.receive_people == 1 %} checked {% endif %} value="1"/>指定人　
                                         <input type="text" class="inputNam" name="receive_people" id="receive_people" value={% if notice.receive_people == 1 %} "{{people}}" {% endif %}/>
                                        <input type="button" value="选择接收人"  onclick="onClick('../received/{{circle_id}}');" class="quanz" onMouseOver="this.className='Upquanz'" onMouseOut="this.className='Offquanz'"  />　
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                 <div class="Qx1">
                                    <div class="Qx11">是否回执：</div>
                                    <div class="Qx12">
                                    	<input type="radio" name ="back" value="1"{%if notice.back ==1%} checked {% endif%}/>是　
                                        <input type="radio" name="back" value="0" {%if notice.back ==0%} checked {% endif%}/>否　
                                     </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="Qx1">
                                    <div class="Qx11">通知内容：</div>
                                    <div class="Qx12"><textarea name="content" class="textarea" placeholder="请填写通知内容" required>{{notice.content}}</textarea></div>
                                    <div class="clear"></div>
                                </div>
                                <div class="Qx1">
                                    <div class="Qx11">通知附件：</div>
                                    <div class="Qx12">
                                       <input type="file" name="notice_fujian" value=""/>{{notice.fujian_name}}
                                       <!-- <input type="button" value="添加"  class="xizbts"  onMouseOver="this.className='Upxizbts'" onMouseOut="this.className='Offxizbts'" />　-->
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="Qx1">
                                    <div class="Qx11">　　　　</div>
                                    <div class="Qx12">
                                     {{ submit_button('确定', 'class': 'Okbut', 'onclick': 'return SignUp.validate();','onMouseOver':'return this.className="UpOkbut"','onMouseOut':'return this.className="OffOkbut"') }}
                                        <input type="reset" value="取消" class="Okbutqx" onMouseOver="this.className='UpOkbutqx'" onMouseOut="this.className='OffOkbutqx'"/>
                                    </div><br />
                                    <div class="clear"></div>
                                    </from>
                                 </div>

                                </form>

