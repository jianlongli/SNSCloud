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
	<div class="fbtoz1">我的作业</div>
    <div class="fbtoz1">
    	<table>
        	<tr class="tabletr">
            	<td>作业名称</td>
                <td>截止日期</td>
                <td>是否提交</td>
                <td>提交进度</td>
                <td>所属圈</td>
            </tr>


            <?php foreach($mywork_data as $val){ ?>
        	<tr>
            	<td style="text-align:left; padding-left:8px;"><a href="#" onclick=" $.alertUrl('/work/addwork/?workid=<?php echo $val->workid; ?>&type=look', '　交作业', 730,350);"><? echo $val->name; ?></a></td>
                <td><?php echo date("Y-m-d H:i:s",$val->endtime); ?></td>
                <td id="sbwork_is<?php echo $val->commitid; ?>"><?php if($val->iscommit!='') echo '已经提交'; else echo '未提交'; ?></td>
				<?php if($val->iscommit!=""){?>
                <td><a href="#"><?php echo $val->username; ?>的作业</a></td>
				<?php }else if($val->endtime<time()){ ?> 
				<td><a href="#">已过期</a></td>
				<?php }else { ?>
				<td id="sbwork<?php echo $val->commitid; ?>"><a href="#" onclick=" $.alertUrl('/work/addwork/?workid=<?php echo $val->workid; ?>', '　交作业', 730,450);">交作业</a></td>
				<?php }?>
                <td><? echo $val->cirlename; ?></td>
            </tr>
            <?php }?>
            
        </table>
    </div>
</body>
</html>



