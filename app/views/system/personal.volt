<?php echo $this->tag->javascriptInclude('./eduis/js/jquery.min.js'); ?>
<script src="./circlestatic/js/_dev/src/explorer/system.js" type="text/javascript"></script>
<script src="./circlestatic/js/_dev/src/explorer/common.js" type="text/javascript"></script>

<?php if($userDetail){?>
<form id="personalForm" action="/system/personal/update" method="POST">
<ul>
	<li>
        <div class="xtulleft">用户名：</div>
        <div class="xtulright" id="username" name="username"> <?php echo $userDetail->username;?></div>
        <div class="clear"></div>
    </li>
   <li>
	   <div class="xtulleft">登录密码：</div>
	   <div class="xtulright"><input type="password" class="xtrpsw" name="password" id="password"/><span>*&nbsp;6-8位，不含特殊符号</span></div>
	   <div class="clear"></div>
   </li>
   <li>
	   <div class="xtulleft">确认密码：</div>
	   <div class="xtulright"><input type="password" class="xtrpsw" name="repassword" id="repassword"/><span>*</span></div>
	   <div class="clear"></div>
   </li>
   <li>
        <div class="xtulleft">性别：</div>
        <?php if($userDetail->sex == 1){?>
        	<div class="xtulright"><input type="radio" name="sex" value="1" checked="checked" />男&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="sex" value="0" />女</div>
        <?php }else{ ?>
        	<div class="xtulright"><input type="radio" name="sex" value="1" />男&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="sex" value="0" checked="checked" />女</div>
        <?php }?>
        <div class="clear"></div>
   </li>
   <li>
        <div class="xtulleft">生日：</div>
        <div class="xtulright"><input type="text" class="xtrtex" name="birthday" id="birthday" value="<?php echo $userDetail->birthday;?>" /></div>
        <div class="clear"></div>
   </li>
   <li>
        <div class="xtulleft">邮箱：</div>
        <div class="xtulright"><input type="text" class="xtrpsw" name="email" id="email"  value="<?php echo $userDetail->email;?>" /></div>
        <div class="clear"></div>
   </li>
   <li>
        <div class="xtulleft">电话：</div>
        <div class="xtulright"><input type="text" class="xtrpsw" name="phone" id="phone" value="<?php echo $userDetail->phone;?>" /></div>
        <div class="clear"></div>
   </li>
   <li>
        <div class="xtulleft">照片：</div>
        <div class="xtulright">
        	<div class="zhaop"><img src="/circlestatic/images/zp.jpg" /></div>
        	<input type="hidden" class="xtrpsw" name="avator"  value="zp.jpg"/>
        </div>
        <div class="clear"></div>
   </li>
   <li>
        <div class="xtulleft">单位：</div>
        <div class="xtulright">
           <select class="xtrsele" name="provinceid" id="provinceid"><option value="1">省市</option></select>
           <select class="xtrsele" name="cityid" id="cityid"><option value="18">区县</option></select>
           <input type="text" class="xtrpsw" name="county" id="county"/>
        </div>
        <div class="clear"></div>
   </li>
   <li>
        <div class="xtulcent">
         <input type="submit" value="保存" class="OffOkbut" />
        </div>
        <div class="clear"></div>
   </li>
</ul>
</form>
<?php }else{ ?>
	<p>no date</p>
<?php } ?>
<script>
	$(function(){
		$('#personalForm').live('submit',function(){
			$.common._ajax('personalForm',systemCallback);
			return false;
		});
	});

</script>
