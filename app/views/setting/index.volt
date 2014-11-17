
{{ stylesheet_link('./static/style/login.css') }}

<div class="loginbox pop_fadein">
	<div class="title">
		<div class="logo">教育即<b>云盘系统</b></div>
		<div class='info'>——教育资源管理器</div>
	</div>
    {{ form('session/start', 'class': 'form-inline') }}

		<div class="inputs">			
			<div><span>用户名：</span>{{ text_field('username', 'size': "30", 'class': "input-xlarge", 'id': 'username', 'placeholder': '用户名', 'pattern': '^[a-zA-Z][a-zA-Z0-9-_\.]{5,12}$', 'title': '用户名必须由6-15位英文或数字组成，且首字母必须为英文' ) }}</div>
			<div><span>密码：</span><input id="password" name='password' type="password" placeholder="密码" pattern="^[a-zA-Z0-9-_\.]{6,12}$" title="密码必须由6-15位英文或数字组成" required/></div>
		</div>

		<div class="actions">
        	{{ submit_button('登陆', 'id': 'submit') }}		
			<input type="checkbox" class="checkbox" name="rember_password" id='rm' checked='checked' />
			<label for='rm'>记住密码</label>
			{{ content() }}			
		</div>

		<div class="msg"></div>
		<div style="clear:both;"></div>

		<div class='guest'>
            {{ link_to('session/register', '用户注册', 'class': 'icon-arrow-right') }}
		</div>
	</form>
</div>

<div class="footer">教育即 2014 © All Rights Reserved.| 
	<a href="" target="_blank">教育即</a>
	<i>  (v1.0.0)</i>
</div>
