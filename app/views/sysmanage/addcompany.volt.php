<?php echo $this->tag->stylesheetLink('./eduis/css/styletcs.css'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/alertInfo.js'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/common.js'); ?>
<script>
	$(document).ready(function(){
		$('#addcompanyForm').bind('submit',function(){
				$.common._ajax('addcompanyForm',formCallback);
				return false;
		});
	});
				
	function formCallback(data){
		$.common._showMsg ('message', data);
	}
	
</script>
  <div class="DWgl">
    <div id="message"></div>
  	<form id='addcompanyForm' action='/sysmanage/addcompany' method="POST">
  	<ul>
    	<li>
        	<li>
        	<div class="xtulleft">单位名称：</div>
            <div class="xtulright"><input type="text" class="xtrpsw" name="name"/><span  class="spancolor">*</span></div>
            <div class="clear"></div>
        </li>
        </li>
        <li>
        	<div class="xtulleft">所属区域：</div>
            <div class="xtulright">
            	<select class="xtrsele1" name="disid">
            		<?php foreach($districtLists as $val){?>
            		<option value="<?php echo $val['id']?>" ><?php echo $val['name'];?></option>
            		<?php }?>
            	</select>
            </div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">电话：</div>
            <div class="xtulright"><input type="text" class="xtrpsw" name="phone"/></div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulcent">
                 <input type="submit" value="保存" class="Okbutq" onMouseOver="this.className='UpOkbutq'" onMouseOut="this.className='OffOkbutq'"  />
                 <input type="submit" value="返回" class="Okbutq1" onMouseOver="this.className='UpOkbutq1'" onMouseOut="this.className='OffOkbutq1'" />
         	</div>
        </li>
    </ul>
    </form>
  </div>