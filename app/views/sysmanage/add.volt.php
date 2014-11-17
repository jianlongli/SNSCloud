<?php echo $this->tag->stylesheetLink('./eduis/css/styletcs.css'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/jquery.min.js'); ?>
<?php echo $this->tag->javascriptInclude('./static/js/lib/artDialog/jquery-artDialog.js?skin=default'); ?>

  <div class="YHgl">
  
  	<ul>
    	<li>
        	<div class="xtulleft">用户名：</div>
            <div class="xtulright">
            	<input type="text" class="xtrpsw"/>
            	<span  class="spancolor">*&nbsp;建议用常用邮箱或QQ作为用户名</span>
            </div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">密码：</div>
            <div class="xtulright">
            	<input type="password" class="xtrpsw"/>
                <span  class="spancolor">*&nbsp;长度&nbsp;3~20&nbsp;个字符</span>
            </div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">确认密码：</div>
            <div class="xtulright">
            	<input type="password" class="xtrpsw"/>
                <span  class="spancolor">*&nbsp;长度&nbsp;3~20&nbsp;个字符</span>
            </div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">角色：</div>
            <div class="xtulright">
            	<span><input type="checkbox"/>普遍用户组</span>
                <span><input type="checkbox"  class="span"/>专家</span>
                <span><input type="checkbox"  class="span"/>超级管理员</span>
                <span><input type="checkbox"  class="span"/>区域管理员</span>
                <span  class="spancolor">*</span>
            </div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">用户身份：</div>
            <div class="xtulright">
            	<span><input type="radio" />一般注册用户</span>
                <span><input type="radio" />行政管理人员</span>
                <span><input type="radio" />教职员工</span>
                <span><input type="radio" />学生</span>
                <span><input type="radio" />家长</span>
                <span  class="spancolor">*</span>
            </div>
            <div class="clear"></div>   
        </li>
        <li>
        	<div class="xtulleft">真实姓名：</div>
            <div class="xtulright"><input type="text" class="xtrpsw"/> <span  class="spancolor">*&nbsp;不能超过20&nbsp;个字符</span></div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">性别：</div>
            <div class="xtulright">
                <span><input type="radio" />男</span>
                <span><input type="radio"  class="span"/>女</span>
                <span class="spancolor">*</span>
            </div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">单位：</div>
            <div class="xtulright"><input type="text" class="xtrpsw"/></div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulcent">
                 <input type="submit" value="确定" class="Okbutq"  />
                 <input type="submit" value="取消" class="Okbutq1"  />
         	</div>
        </li>
    </ul>
  </div>

  <script>
	$(function(){
		$(".Okbutq1").live('click',function(){
			art.dialog.open('http://www.baidu.com', {title: '提示'});
		});
	});
  </script>
  
  
  
  
  
  