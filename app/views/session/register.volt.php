
<?php echo $this->tag->stylesheetLink('./JinSongSiXiao/css/style.css'); ?>
<?php echo $this->tag->javascriptinclude('./JinSongSiXiao/js/home/jquery-1.9.1.js'); ?>
<?php echo $this->tag->javascriptinclude('./JinSongSiXiao/js/home/alertInfo.js'); ?>
<?php echo $this->tag->javascriptinclude('./JinSongSiXiao/js/home/home.js'); ?>

<body class="body">
	<div class="czInfo" id="ShowDIV" >
      	<div class="AlerInfo">
		<?php echo $this->tag->form(array('session/register', 'id' => 'registerForm', 'class' => 'form-horizontal', 'onbeforesubmit' => 'return false')); ?>		
            <div class="Aler1"><div class="Actenr"><h3>用户注册</h3></div></div>
            <div class="Aler1">
                <div class="Aler11"><span>*</span>用户名：</div>
                <div class="Aler12"><input id="username" class="Ainput" name='username' type="text" placeholder="用户名" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{5,12}$" title="用户名必须由6-15位英文或数字组成，且首字母必须为英文" required/>
<br /><span>-- 用户名必须由6-15位英文或数字组成，且首字母必须为英文</span></div>
                <div class="clear"></div>
            </div>
            <div class="Aler1">
                <div class="Aler11"><span>*</span>密码：</div>
                <div class="Aler12"><input class="Ainput" id="password" name='password' type="password" placeholder="********" pattern="^[a-zA-Z0-9-_\.]{6,12}$" title="密码必须由6-15位英文或数字组成" required/><br /><span>-- 密码必须由6-15位英文或数字组成</span></div>
                <div class="clear"></div>
            </div>
            <div class="Aler1">
                <div class="Aler11"><span>*</span>确认密码：</div>
                <div class="Aler12"><input class="Ainput" id="repassword" name='repassword' type="password" placeholder="********" pattern="^[a-zA-Z0-9-_\.]{6,12}$" title="密码必须由6-15位英文或数字组成" required/><br /><span>-- 密码必须由6-15位英文或数字组成</span></div>
                <div class="clear"></div>
            </div>
            <div class="Aler1">
                <div class="Aler11"><span>*</span>真实姓名：</div>
                <div class="Aler12"><input class="Ainput" id="name" name='name' type="text" placeholder="姓名" required/></div>
                <div class="clear"></div>
            </div>
             <div class="Aler1">
                <div class="Aler11">邮箱地址：</div>
                <div class="Aler12"><input class="Ainput" id="email" name='email' type="text" placeholder="xxxxxx@xxx.com" pattern="^[0-9a-zA-Z]+(?:[\.\!\#\$\%\^\&\*\'\+\-\/\`\_\{\|\}\~]{0,1}[a-zA-Z0-9]+)*@[a-zA-Z0-9\-]+\.[0-9a-zA-Z\-]+$" title="请填写正确的电子邮箱地址" required/><br /><span>-- 请填写正确的电子邮箱地址，以方便密码找回等功能</span></div>
                <div class="clear"></div>
            </div>
            <div class="Aler1"><div class="Actenr">
				<?php echo $this->getContent(); ?>
            	<?php echo $this->tag->submitButton(array('onclick' => 'return checkPassword();', 'style' => 'background:url(../JinSongSiXiao/imge/inserbut.png) no-repeat top left; width:80px; height:36px; border:none; cursor:pointer;  outline: none; font-size: 0;')); ?>
			</div></div>
			</form>
    	</div>
        <div class="shoolbottom">
        	<!--版权-->
        	<div class="shoolBleft">
               <p>北京华信恒业科技有限公司　版权所有 </p>
               <p>Copyright2014　京ICP3655220 </p>
           </div>
           <div class="shoolBright">
           <!--教育G盘、教育圈、微课例视频-->
           	<ul>
            	<li><input type="button" value="" class="shoolbut1" /></li>
                <li><input type="button" value="" class="shoolbut2" /></li>
                <li><input type="button" value="" class="shoolbut3" /></li>
            </ul>
           </div>
           <div class="clear"></div>
      	</div>
    </div>

	<script type="text/javascript">
	function checkPassword() {
		var password 	= document.getElementById("password").value;
		var repassword	= document.getElementById("repassword").value;
		var checkPwd	= document.getElementById("checkPwd");

		if (password != repassword) {
			//alert(document.getElementById("checkPwd").innerHTML);
			checkPwd.innerHTML= "<span>两次输入的密码不一致</span>";
			return false;
		}
	}
	</script>

</body>

