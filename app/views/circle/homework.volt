<?php echo $this->tag->stylesheetLink('./eduis/css/styletcs.css'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/alertInfo.js'); ?>
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
        	<tr>
            	<td style="text-align:left; padding-left:8px;"><a href="#" onclick=" $.alertUrl('我的圈子-作业管理-我的作业-交作业.html', '　交作业', 730, 400);">作业名称1</a></td>
                <td>2014.10.11</td>
                <td>已经提交</td>
                <td><a href="#">杨帆的作业</a></td>
                <td>数学教研圈</td>
            </tr>
            <tr>
            	<td  style="text-align:left; padding-left:8px;"><a href="#">作业名称1</a></td>
                <td>2014.10.11</td>
                <td>未提交</td>
                <td><a href="#" onclick=" $.alertUrl('交作业.html', '　交作业', 730,450);">交作业</a></td>
                <td>数学教研圈</td>
            </tr>
            <tr>
            	<td  style="text-align:left; padding-left:8px;"><a href="#"></a></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
            	<td  style="text-align:left; padding-left:8px;"><a href="#"></a></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
            	<td  style="text-align:left; padding-left:8px;"><a href="#"></a></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>