<?php echo $this->tag->stylesheetLink('./eduis/css/styletcs.css'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/alertInfo.js'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/SeekTp.js'); ?>
  <div class="" >
  	<div class="Qxq">
    	<div class="Qx11">姓名：</div>
        <div class="Qx12"><input type="text" class="inputNam" name="nicheng" id='nicheng' /></div>
        <div class="clear"></div>
    </div>
    	<div class="Qxq">
    	<div class="Qx11">单位：</div>
        <div class="Qx12"><input type="text" class="inputNam" /></div>
        <div class="clear"></div>
    </div>
    <div class="Qxq">
        <div class="Qx11">已选用户：</div>
        <div class="Qx12"><textarea class="textareaq" disabled></textarea></div>
        <div class="clear"></div>
    </div>
     <div class="Qxq">
     	<div class="Qx11">　　　　</div>
        <div class="Qx12">
        	 <input type="submit" value="确定" class="Okbutq" onMouseOver="this.className='UpOkbutq'" onMouseOut="this.className='OffOkbutq'"  />
            <input type="submit" value="取消" class="Okbutq1" onMouseOver="this.className='UpOkbutq1'" onMouseOut="this.className='OffOkbutq1'" onclick="parent.$.alertdel();" />
        </div><br />
        <div class="clear"></div>
     </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	var oo=new mSift('oo',20);
		
	$('input[name="nicheng"]').bind('keyup',function(){
		var _val = $(this).val();
		if (_val.trim()){
			var _str = '';
			$.ajax({
	            url: '/circle/getname/',
	            type: 'post',
	            data: {'val':_val},
	            dataType: "json",
	            success: function ( _data ) {
					oo.Data=['JavaScript特效','JS效果','Js代码','Java特效','Javascript代码','JS脚本','Js是什么意思','Java','Java游戏'];
	            	if (_data.statu == 1) {
	            		$.each(_data.data, function(i, n){
	            			_str += n.userName + ',';
	            		});
						oo.Create(document.getElementById('nicheng'));
	            	}
	            }
	        });
		}
	});
});
</script>