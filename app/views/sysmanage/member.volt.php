<?php echo $this->tag->stylesheetLink('./eduis/css/styletcs.css'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/jquery.min.js'); ?>
<?php echo $this->tag->javascriptInclude('./static/js/lib/artDialog/jquery-artDialog.js?skin=default'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/_dev/src/explorer/common.js'); ?>

  <div class="YHgl">
  	<div id="message" style="display:none;"></div>
    <form id='addMemberForm' action='/sysmanage/member/add' method="POST">
  	<ul>
    	<li>
        	<div class="xtulleft">用户名：</div>
            <div class="xtulright">
            	<input type="text" class="xtrpsw" name="username" id="username"/>
            	<span  class="spancolor">*&nbsp;用户名不能为空</span>
            </div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">邮箱：</div>
            <div class="xtulright">
            	<input type="text" class="xtrpsw" name="email" id="email"/>
            	<span  class="spancolor">*&nbsp;邮箱不能为空</span>
            </div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">密码：</div>
            <div class="xtulright">
            	<input type="password" class="xtrpsw" name="password" id="password"/>
                <span  class="spancolor">*&nbsp;长度&nbsp;3~20&nbsp;个字符</span>
            </div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">确认密码：</div>
            <div class="xtulright">
            	<input type="password" class="xtrpsw" name="repassword" id="repassword"/>
                <span  class="spancolor">*&nbsp;长度&nbsp;3~20&nbsp;个字符</span>
            </div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">角色：</div>
            <div class="xtulright">
            	<?php foreach($roleLists as $k => $v ){?>
            	<span><input type="radio" name="role_id" id="rele_id" value="<?php echo $v[id];?>" /><?php echo $v['name'];?></span>
            	<?php }?>
                <span  class="spancolor">*</span>
            </div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">用户身份：</div>
            <div class="xtulright">
            	<?php foreach($identityLists as $kk => $vv){?>
            	<span><input type="radio" name="identity" id="identify" value="<?php echo $vv[name];?>" /><?php echo $vv[name];?></span>
    			<?php }?>
                <span  class="spancolor">*</span>
            </div>
            <div class="clear"></div>   
        </li>
        <li>
        	<div class="xtulleft">真实姓名：</div>
            <div class="xtulright"><input type="text" class="xtrpsw" name="name" id="name" /> <span  class="spancolor">*&nbsp;不能超过20&nbsp;个字符</span></div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">性别：</div>
            <div class="xtulright">
                <span><input type="radio" name="sex" value="1" checked="checked"/>男</span>
                <span><input type="radio"  name="sex" value="0" class="span"/>女</span>
                <span class="spancolor">*</span>
            </div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">单位：</div>
            <div class="xtulright"><input type="text" name="company" id="company" class="xtrpsw"/></div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulcent">
                 <input type="submit" value="确定" class="Okbutq"  />
                 <input type="button" value="取消" class="Okbutq1"  />
         	</div>
        </li>
    </ul>
    </form>
  </div>

  <script>
	$(function(){
		$(".Okbutq1").live('click',function(){
			art.dialog.close();
		});
		
		$('#addMemberForm').bind('submit',function(){
			$.common._ajax('addMemberForm',addMemberFormCallback);
			//art.dialog.close();
			return false;
		});
		
	});
	
	function addMemberFormCallback( _data ){
		console.log(_data);
		if(!_data.code){
			$.common._showMsg ('message', _data.data);
		}else{
			$.common._showMsg ('message', _data.data);
			//art.dialog.close();
		}
	}
	
  </script>
  
  
  
  
  
  