
{{ stylesheet_link('./eduis/css/style.css') }}
{{ javascriptInclude('./eduis/js/home/jquery-1.9.1.js') }}
{{ javascriptInclude('./eduis/js/home/alertInfo.js') }}
{{ javascriptInclude('./eduis/js/home/home.js') }}

<body class="body">
	<div class="homeInfo" id="ShowDIV" >
    <div class="homecen">
    		<!--教育G盘、教育圈、微课例视频-->
        	<div class="homecenleft">
            	<table >
                	<tr>
                    	<td valign="bottom" class="indleftd"><a href="#"><img src="../../eduis/images/Gp1.png" /></a></td>
                        <td valign="top" class="indleftd1" ><a href="#"><img src="../../eduis/images/jy1.png" /></a></td>
                    </tr>
                   <!-- <tr>
                    	<td colspan="2"  class="indleftd2"><a href="#"><img src="../../eduis/images/wk.png" /></a></td>
                    </tr>-->
                </table>
                <div class="indleftd2"><a href="#"><img src="../../eduis/images/wk.png" /></a></div>
            </div>
            <!--用户登录-->
            <div class="homecenright">
            	<div class="indadmin">
            	    {{ form('session/start', 'class': 'form-inline') }}
            	
                	<!--<input type="text"  class="inoputxx" />-->
                	<p>用户名：{{ text_field('username', 'size': "30", 'class': "input-xlarge", 'id': 'username', 'placeholder': '用户名', 'pattern': '^[a-zA-Z][a-zA-Z0-9-_\.]{5,12}$', 'title': '用户名必须由6-15位英文或数字组成，且首字母必须为英文' ) }}</p>
                    <p class="inrp">密　码：<input id="password" name='password' type="password" placeholder="密码" pattern="^[a-zA-Z0-9-_\.]{6,12}$" title="密码必须由6-15位英文或数字组成" required/></p>
                    <p class="ind"><?php echo $this->tag->submitButton(array('登陆', 'style'=>'width: 68px; height: 29px; font-size: 14px; background: url(../../eduis/images/userbut.png); color: #FFF; padding: 5px 20px; border:0px solid #c11f28;' )); ?>{{ link_to('session/register', '注册') }}</p>
                    </form>
                   <div style='color: #FFF; margin-left: 55px; '>{{ content() }}</div> 
                </div>
            </div>
        </div>
        <!--版权-->
        <div class="homebottom">
          <p>北京教育即公司 版权所有</p>
            <p>copyright (c) 2014 Eduis Co.,Ltd.All Rights Reserved. </p>
      	</div>
    </div>
</body>

<!--
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
-->

