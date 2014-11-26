<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
<?php echo $this->tag->stylesheetLink('./eduis/css/styletcs.css'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/jquery.min.js'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/alertInfo.js'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/zz.js'); ?>
</head>
<body>
   	<div class="fbtoz">交作业</div>
	<input name="workid" id="workid" type="hidden" value="<?php echo $work->workid; ?>" />
    <div class="fbtoz">
      <div class="Qx11">作业名称：<span><?php echo $work->title; ?></span></div>
      <div class="clear"></div>
    </div>
    <div class="fbtoz">
      <div class="Qx11">作业说明：<span><?php echo $work->description; ?></span></div>
       <div class="clear"></div>
     </div>
    <div class="fbtoz">
      	<div class="Qx11">发布日期：<span><?php echo date("Y-m-d H:i:s",$work->starttime); ?></span></div>
        <div class="clear"></div>
    </div>
    <div class="fbtoz">
      <div class="Qx11">提交截止：<span><?php echo date("Y-m-d H:i:s",$work->endtime); ?></span></div>
      <div class="clear"></div>
    </div>  
    <div class="fbtoz">
      <div class="Qx11">作业附件：
<form action="addwork/?type=submit&workid=<?php echo $work->workid; ?>" method="post" enctype="multipart/form-data">
      	<span>
        	<ul>
            	<li>
                	<input type="text" class="fbinput" name=""/>
                    <input type="file" class='file'  name="filename1"/>
            		<input type="button" value="增加" class="xizbt1"  onMouseOver="this.className='Upxizbt1'" onMouseOut="this.className='Offxizbt1'" onclick="addfj();"/>
                </li>
                <li>
                <input type="text" class="fbinput" />
            	<input type="file" class='file' name="filename2"/>
                </li>
				<span id="addfj"></span>
            </ul>
        </span><br />
      </div>
      <div class="clear"></div>
    </div>      
     <div class="fbtoz">
      	<input type="submit" value="确定" class="Okbutq" onMouseOver="this.className='UpOkbutq'" onMouseOut="this.className='OffOkbutq'"  onclick="submit();"/>
        <input type="submit" value="取消" class="Okbutq1" onMouseOver="this.className='UpOkbutq1'" onMouseOut="this.className='OffOkbutq1'" />
      <div class="clear"></div>
    </div>  
</form>    
</body>
</html>
<script type="text/javascript">
	var j=2;
	function addfj(){
		j++;
		$("#addfj").append("<li><input type='text' class='fbinput' /><input type='file' class='file' name='filename"+j+"'/></li>"); 
	}
	function submit(){
		var files="";
		$(".file").each(function(){
			files=files+"|"+$(this).val();
		})
		var workid=$("#workid").val();
		$.ajax({
				url:'/work/addwork/?type=submit&files='+files+"&workid="+workid,
				dataType:'json',
				success:function(data){
					alert(data.data);
				},
			});
	}
</script>

