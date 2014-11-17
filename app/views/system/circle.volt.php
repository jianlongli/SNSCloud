<ul>
	<li>
    	<div class="yhulleft">
        	<span>分类：<input type="text" class="xtrpsw" /></span>
            <span>状态：<input type="text" class="xtrpsw" /></span>
        </div>
    	<div class="yhulright">
         <input type="text" class="xtrpsw"/>
         <input type="button"  value="查询" class="XTOk" onMouseOver="this.className='XTUpOk'" onMouseOut="this.className='XTOffOk'" />
        </div>
        <div class="clear"></div>
    </li>
    <li>
    	<div class="yqul">
            <table>
                <tr class="yqtr">
                    <td>圈子名称</td>
                    <td>圈主</td>
                    <td>分类</td>
                    <td>单位</td>
                    <td>创建时间</td>
                    <td>审批状态</td>
                    <td>操作</td>
                </tr>
                <tr>
                    <td style="text-align:left"><a href="#" onclick=" $.alertUrl('系统管理-圈子审批-圈子审核页面.html', '　圈子审核', 700, 550);">圈子a</a></td>
                    <td>刘美</td>
                    <td>语文</td>
                    <td>和平街一中</td>
                    <td>2014.10.12</td>
                    <td>未审核</td>
                    <td>
                    	 <input type="button" value="审核"  class="deletBut1" onclick=" $.alertUrl('系统管理-圈子审批-圈子审核页面.html', '　圈子审核', 700, 550);"/>
                         <input type="button" value="删除"  class="deletBut1"/>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:left"><a href="#" onclick=" $.alertUrl('系统管理-圈子审批-圈子审核页面.html', '　圈子审核', 700, 550);">圈子b</a></td>
                    <td>刘美</td>
                    <td>语文</td>
                    <td>和平街一中</td>
                    <td>2014.10.12</td>
                    <td>未通过</td>
                    <td>
                    	 <input type="button" value="审核"  class="deletBut1" onclick=" $.alertUrl('系统管理-圈子审批-圈子审核页面.html', '　圈子审核', 700, 550);"/>
                         <input type="button" value="删除"  class="deletBut1"/>
                    </td>
                </tr>
                <tr>
                     <td style="text-align:left"><a href="#" onclick=" $.alertUrl('系统管理-圈子审批-圈子审核页面.html', '　圈子审核', 700, 550);">圈子c</a></td>
                    <td>刘美</td>
                    <td>语文</td>
                    <td>和平街一中</td>
                    <td>2014.10.12</td>
                    <td>未审核</td>
                    <td>
                    	 <input type="button" value="审核"  class="deletBut1" onclick=" $.alertUrl('系统管理-圈子审批-圈子审核页面.html', '　圈子审核', 700, 550);"/>
                         <input type="button" value="删除"  class="deletBut1"/>
                    </td>
                </tr>
            </table>
        </div>
    </li>
    <li>
    	<div class="xtulleft"><input type="button"  value="新建" class="XTOk" onMouseOver="this.className='XTUpOk'" onMouseOut="this.className='XTOffOk'"  onclick=" $.alertUrl('系统管理-圈子审批-新建圈子.html', '　新建圈子', 700, 600);"/></div>
        <div class="xtulright">
        	<div class="xtRleft">总共有&nbsp;<span>3456</span>条</div>
            <div class="xtRcent">每条记录数&nbsp;<select class="xtrsele"><option></option></select></div>
            <div class="xtRrighg">
                <span><a href="#" class="inpubolr">首页</a></span>
                <span><a href="#" class="inpubolr">上一页</a></span>
                <span><a href="#">1</a></span>
                <span><a href="#">2</a></span>
                <span><a href="#">3</a></span>
                <span><a href="#">4</a></span>
                <span><a href="#">5</a></span>
                <span><a href="#" class="inpubolr">下一页</a></span>
                <span><a href="#" class="inpubolr">尾页</a></span>
            </div>
             <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </li>
</ul>