<?php echo $this->tag->stylesheetLink('./eduis/css/styletcs.css'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/alertInfo.js'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/common.js'); ?>
<script>
	$(document).ready(function(){
		$('#adduserForm').bind('submit',function(){
				$.common._ajax('adduserForm',formCallback);
				return false;
		});
	});
				
	function formCallback(data){
		$.common._showMsg ('message', data);
	}
	
</script>
  <div class="YHgl">
  <div id="message"></div>
  <form id='adduserForm' action='/sysmanage/adduser' method="POST">
  	<ul>
    	<li>
        	<div class="xtulleft">用户名：</div>
            <div class="xtulright">
            	<input type="text" class="xtrpsw" name="username"/>
            	<span  class="spancolor">*&nbsp;建议用常用邮箱或QQ作为用户名</span>
            </div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">密码：</div>
            <div class="xtulright">
            	<input type="password" class="xtrpsw" name="password"/>
                <span  class="spancolor">*&nbsp;长度&nbsp;3~20&nbsp;个字符</span>
            </div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">确认密码：</div>
            <div class="xtulright">
            	<input type="password" class="xtrpsw" name="repeatPassword"/>
                <span  class="spancolor">*&nbsp;长度&nbsp;3~20&nbsp;个字符</span>
            </div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">角色：</div>
            <div class="xtulright">
            	<span><input type="checkbox" name="role" value='1'/>普遍用户组</span>
                <span><input type="checkbox"  name="role" value='2' class="span"/>专家</span>
                <span><input type="checkbox"  name="role" value='3' class="span"/>超级管理员</span>
                <span><input type="checkbox"  name="role" value='4' class="span"/>区域管理员</span>
                <span  class="spancolor">*</span>
            </div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">用户身份：</div>
            <div class="xtulright">
            	<span><input type="radio" name="identity" value='1' />一般注册用户</span>
                <span><input type="radio" name="identity" value='2' />行政管理人员</span>
                <span><input type="radio" name="identity" value='3' />教职员工</span>
                <span><input type="radio" name="identity" value='4' />学生</span>
                <span><input type="radio" name="identity" value='5' />家长</span>
                <span  class="spancolor">*</span>
            </div>
            <div class="clear"></div>   
        </li>
        <li>
        	<div class="xtulleft">真实姓名：</div>
            <div class="xtulright"><input type="text" class="xtrpsw" name="name" /> <span  class="spancolor">*&nbsp;不能超过20&nbsp;个字符</span></div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">性别：</div>
            <div class="xtulright">
                <span><input type="radio" name="sex" value="1" />男</span>
                <span><input type="radio"  name="sex" value="0" class="span"/>女</span>
                <span class="spancolor">*</span>
            </div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">单位：</div>
            <div class="xtulright"><input type="text" class="xtrpsw" name="company" /></div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulcent">
                 <input type="submit" value="确定" class="Okbutq" onMouseOver="this.className='UpOkbutq'" onMouseOut="this.className='OffOkbutq'"  />
                 <input type="reset" value="取消" class="Okbutq1" onMouseOver="this.className='UpOkbutq1'" onMouseOut="this.className='OffOkbutq1'" />
         	</div>
        </li>
    </ul>
    </form>
  </div>