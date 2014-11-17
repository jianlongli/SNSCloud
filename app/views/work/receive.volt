<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
<?php echo $this->tag->stylesheetLink('./eduis/css/styletcs.css'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/jquery.min.js'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/alertInfo.js'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/zz.js'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/_dev/src/explorer/common.js'); ?>

</head>
<body">
 <div id="tishi"></div>
                  <div class="" >
					<input name="circleid" id="circleid" type="hidden" value="<?php echo $circleId ?>" />
                  	<div class="Qxq">
                    	<div class="Qx11">姓名：</div>
                        <div class="Qx12"><input type="text" class="inputNam" id="seach_text"/>&nbsp;<input type="button" value="查询"  class="xizbts"  onMouseOver="this.className='Upxizbts'" onMouseOut="this.className='Offxizbts'" onclick="seach();"/></div>
                        <div class="clear"></div>
                    </div>
                    <div class="Qxq">
                    	<table class="xztr" id="seach_data_show">
                        	<tr class="trd">
                            	<td width="42"><input type="checkbox" id="allcheck" onclick="allchak();"/></td>
                                <td width="210">姓名</td>
                                <td>学校</td>
                            </tr>
						<?php foreach($member_data as $val){ ?>
                            <tr>
                            	<td><input type="checkbox" name="putname" value="<?php echo $val->member_id; ?>"/></td>
								<input name="checkname<?php echo $val->member_id; ?>" id="checkname<?php echo $val->member_id; ?>" type="hidden" value="<?php echo $val->username; ?>" />
                                <td><?php echo $val->username; ?></td>
                                <td>石景山二小1</td>
                            </tr>
						<?php } ?>
                        </table>
                    </div>
                     <div class="Qxq">
                     	<div class="Qx11">　　　　</div>
                        <div class="Qx12">
                            <input type="submit" value="确定" class="Okbutq" onMouseOver="this.className='UpOkbutq'" onMouseOut="this.className='OffOkbutq'"  onclick="submit_ok();"/>
                            <input type="submit" value="取消" class="Okbutq1" onMouseOver="this.className='UpOkbutq1'" onMouseOut="this.className='OffOkbutq1'" onclick="close_this();"/>
                        </div><br />
                        <div class="clear"></div>
                     </div>
                  </div>
                </div>
</div>
</body>
</html>

<script type="text/javascript">
	function submit_ok(){
		var chk_value =[];  
		var chk_name =[];		
		$('input[name="putname"]:checked').each(function(){    
			chk_value.push($(this).val());
			chk_name.push($("#checkname"+$(this).val()).val());
			
		});   
		if(chk_value.length==0){
			$.common._showMsg('tishi','请选择接收人');
			return false;
		}else{
			window.parent.document.getElementById("receiveid").value=chk_name;
			window.parent.document.getElementById("hdreceiveid").value=chk_value;
			close_this();
		}

	}
	function close_this(){
		parent.$(".hialertcalss").remove();
		parent.$(".alertcalss").remove()
		
	}
	function seach(){
	var seach_text=$("#seach_text").val();
	var circleid=$("#circleid").val();
		$.ajax({
				url:'/work/receive/?type=seach&seach_text='+seach_text+"&circleid="+circleid,
				dataType:'json',
				success:function(data){
					$("#seach_data_show").html(data.data);
					
				},
			});
	}
	function allchak(){
			if($("#allcheck").attr("checked")=="checked"){
				$("input[name='putname']").each(function(){
				$(this).attr("checked",true);
				}); 
			}else{
				$("[name='putname']").removeAttr("checked");//取消全选
			}
				 
	}
</script>
