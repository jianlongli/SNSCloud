
<div class="page-header">
    <h2>用户注册</h2>
</div>

{{ form('session/register', 'id': 'registerForm', 'class': 'form-horizontal', 'onbeforesubmit': 'return false') }}
    <fieldset>
        <div class="control-group">
            <label class="control-label" for="name">您的姓名:</label>
            <div class="controls">
				<input id="name" name='name' type="text" placeholder="张三" required/>
                <p class="help-block"></p>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="username">用户名:</label>
            <div class="controls">
			<input id="username" name='username' type="text" placeholder="username" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{5,12}$" title="用户名必须由6-15位英文或数字组成，且首字母必须为英文" required/>
                <p class="help-block">-- 用户名必须由6-15位英文或数字组成，且首字母必须为英文</p>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="email">邮箱地址:</label>
            <div class="controls">
				<input id="email" name='email' type="text" placeholder="zhangsan@163.com" pattern="^[0-9a-zA-Z]+(?:[\.\!\#\$\%\^\&\*\'\+\-\/\`\_\{\|\}\~]{0,1}[a-zA-Z0-9]+)*@[a-zA-Z0-9\-]+\.[0-9a-zA-Z\-]+$" title="请填写正确的电子邮箱地址" required/>
                <p class="help-block">-- 请填写正确的电子邮箱地址，以方便密码找回等功能</p>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="password">密码:</label>
            <div class="controls">
				<input id="password" name='password' type="password" placeholder="********" pattern="^[a-zA-Z0-9-_\.]{6,12}$" title="密码必须由6-15位英文或数字组成" required/>
                <p class="help-block">-- 密码必须由6-15位英文或数字组成</p>
                <div class="alert" id="password_alert">
                </div>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="repeatPassword">确认密码:</label>
            <div class="controls">
				<input id="repassword" name='repassword' type="password" placeholder="********" pattern="^[a-zA-Z0-9-_\.]{6,12}$" title="密码必须由6-15位英文或数字组成" required/>
            	<p id="checkPwd" style="color:#F00;"></p>
                <div class="alert" id="repeatPassword_alert">
                </div>
            </div>
        </div>
        <div class="form-actions">
			{{ content() }}
            {{ submit_button('注册', 'class': 'btn btn-primary btn-large', 'onclick': 'return checkPassword();') }}
        </div>
    </fieldset>
</form>

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
