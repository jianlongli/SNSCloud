<?php echo $this->tag->stylesheetLink('./eduis/css/style.css'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/home/jquery-1.9.1.js'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/alertInfo.js'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/home/home.js'); ?>

<body class="body">
	<div class="shoolInfo" id="ShowDIV" >
      <div class="shoolcen">
            <!--用户登录-->
			
            <div class="shoolctop">
            {{ form('session/start', 'class': 'form-inline') }}
               <p>{{ text_field('username', 'size': "30", 'class': "sinput", 'id': 'username', 'placeholder': '用户名', 'pattern': '^[a-zA-Z][a-zA-Z0-9-_\.]{5,12}$', 'title': '用户名必须由6-15位英文或数字组成，且首字母必须为英文' ) }}</p>
               <p class="sinp"><input class="sinput" id="password" name='password' type="password" placeholder="密码" pattern="^[a-zA-Z0-9-_\.]{6,12}$" title="密码必须由6-15位英文或数字组成" required/></p>
               <p class="sibut"><?php echo $this->tag->submitButton(array('登陆')); ?><a href="../session/register"><img src="/eduis/images/inserbut.png" /></a></p>
			</from>
            </div>
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
					<li><a href="javascript:;"><img src="/eduis/images/shool1.png" /></a></li>
					<li><a href="javascript:;"><img src="/eduis/images/shool2.png" /></a></li>
					<li><a href="javascript:;"><img src="/eduis/images/shool3.png" /></a></li>
				</ul>
			</div>
      	</div>
    </div>
</body>
