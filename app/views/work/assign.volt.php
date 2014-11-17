<?php echo $this->tag->stylesheetLink('./eduis/css/styletcs.css'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/jquery.min.js'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/alertInfo.js'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/zz.js'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/_dev/src/explorer/common.js'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/lib/My97DatePicker/WdatePicker.js'); ?>

<style>
	body{width:850px;margin:0px;}
	#tishi{width:250px;height: 40px; background-color:red;margin: 0px auto;display: none;font-size: larger;}
</style>
                 <div class="Qx1">
						<div id="tishi"></div>
                    	<div class="Qx11">圈子名称：</div>
                        <div class="Qx12"><?php echo $circname ?></div>
						<input name="circleid" id="circleid" type="hidden" value="<?php echo $circleId ?>" />
						<input name="workid" id="workid" type="hidden" value="" />
                        <div class="clear"></div>
                    </div>
                  	<div class="Qx1">
                    	<div class="Qx11">作业名称：</div>
                        <div class="Qx12"><input type="text" class="inputNam1" name='title' id='title' /></div>
                        <div class="clear"></div>
                    </div>
                    <div class="Qx1">
                         <div class="Qx11">作业介绍：</div>
                         <div class="Qx12"><input type="text" class="inputNam" name='description' id='description'/></div>
                         <div class="clear"></div>
                    </div>
                    <div class="Qx1">
                                    <div class="Qx11">作业对象：</div>
                                    <div class="Qx12">
                                    	<label><input type="Radio" name="receivetype" id="receivetype_y" value="Y" checked/>圈内所有人</label>
                                    	<label><input type="Radio" name="receivetype" id="receivetype_n"  value="N" />指定人</label>
										<input type="text" class="inputNam" id="receiveid" disabled=disabled />　
										<input name="hdreceiveid" id="hdreceiveid" type="hidden" value="" />
										<input type="button" value="选择接收人" onclick="loud_receive('/work/receive/?circleid=<?php echo $circleId ?>');" class="quanz" onMouseOver="this.className='Upquanz'" onMouseOut="this.className='Offquanz'" />　
                                    </div>
                                    <div class="clear"></div>
                                </div>
                    <div class="Qx1">
                    	<div class="Qx11">开始日期：</div>
                        <div class="Qx12"><input readonly style="cursor: pointer;" type="text" class="inputNam1" name='created' id='created' onclick="WdatePicker()"/></div>
                        <div class="clear"></div>
                    </div>
                    <div class="Qx1">
                    	<div class="Qx11">失效日期：</div>
                        <div class="Qx12"><input readonly style="cursor: pointer;" type="text" class="inputNam1" name='endtime' id='endtime' onclick="WdatePicker()"/></div>
                        <div class="clear"></div>
                    </div>
                    <div class="Qx1">
                        <div class="Qx123"> <input type="button" value="确定" class="xizbt1" onMouseOver="this.className='Upxizbt1'" onMouseOut="this.className='Offxizbt1'" id="submit_assign"/></div>
                        <div class="clear"></div>
                    </div>
                    <div class="Qx1">
                    	<div class="Qx11">作业列表：</div>
                        <div class="Qx12"></div>
                        <div class="clear"></div>
                    </div>
                   
                         <div class="cyInfo">
                        	<table class="stable" id="alternatecolor">
                            	
                                
                            </table>
                        </div>

<script type="text/javascript">
	$(document).ready(function() {
		worklist('1');
	});
	
function del(id,page){
	$.ajax({
		url:'/work/assign/?type=del&workid='+id,
		dataType:'json',
		success:function(data){
			worklist(page);
			
		},
	});
}
function loud_receive(url){
	$("#receivetype_n").attr("checked",true);
	$.alertUrl(url, '选择接收人', 600, 500);
}
function redact(id){//编辑
	var htitle=$("#"+id+"htitle").val();
	var hdescription=$("#"+id+"hdescription").val();
	var hcreated=$("#"+id+"hcreated").val();
	var hendtime=$("#"+id+"hendtime").val();
	var hreceiveid=$("#"+id+"hreceiveid").val();
	var hhdreceiveid=$("#"+id+"hhdreceiveid").val();
	var hcircleid=$("#"+id+"hcircleid").val();
	if(hreceiveid==""){
		$("#receivetype_y").attr("checked",true);
	}else{
		$("#receivetype_n").attr("checked",true);
	}
	$("#title").val(htitle);
	$("#description").val(hdescription);
	$("#created").val(hcreated);
	$("#endtime").val(hendtime);
	$("#receiveid").val(hreceiveid);
	$("#hdreceiveid").val(hhdreceiveid);
	$("#workid").val(id);
	
}

</script>