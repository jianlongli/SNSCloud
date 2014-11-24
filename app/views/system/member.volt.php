<?php if($option == 'add') { ?>
	<?php echo $this->tag->stylesheetLink('./eduis/css/styletcs.css'); ?>
	<?php echo $this->tag->javascriptInclude('./eduis/js/jquery.min.js'); ?>
	<?php echo $this->tag->javascriptInclude('./static/js/lib/artDialog/jquery-artDialog.js?skin=default'); ?>
	<?php echo $this->tag->javascriptInclude('./circlestatic/js/_dev/src/explorer/common.js'); ?>
	<div class="YHgl">
  	<div id="message" style="display:none;"></div>
    <form id='addMemberForm' action='/system/member/add' method="POST">
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

<?php }elseif($option == 'edit') { ?>
	xxxxxxxxxxxx
	xxxxxxx
<?php }else{ ?>

<ul>
	<li>
    	<div class="yhulleft">
        	<span><input type="button" value="新增用户" class="yhbut1 memberManage" data="add"/></span>
            <span><input type="button" value="导入用户" class="yhbut2 memberManage" data="import" /></span>
            <span><input type="button" value="导出用户" class="yhbut3 memberManage" data="export" /></span>
        </div>
    	<div class="yhulright">
        <input type="text" class="xtrpsw" id="keyWord" value="<?php echo $page->key; ?>" />
		<input type="hidden" class="inputText" id="keyWordH" value="<?php echo $page->key; ?>" />
		<input type="button"  value="查询" class="XTOk Search"/>
        </div>
        <div class="clear"></div>
    </li>
    <li>
    <?php if($page){?>
    	<div class="yqul">
            <table>
                <tr class="yqtr">
                	<td><input type="checkbox" class="check" id="chooseAll"/></td>
                    <td>用户名</td>
                    <td>真实姓名</td>
                    <td>单位</td>
                    <td>角色</td>
                    <td>状态</td>
                    <td>创建时间</td>
                    <td>操作</td>
                </tr>
                <?php foreach($page->items as $item){ ?>
                <tr>
                	<td><input type="checkbox" class="check" name="chkItem[]"  value="<?php echo $item->userid;?>"/></td>
                    <td style="text-align:left"><a href="#"><?php echo $item->username;?></a></td>
                    <td><?php echo $item->username;?></td>
                    <td><?php echo $item->name;?></td>
                    <td><?php echo $item->role;?></td>
                    <td><?php if($item->status ==0){echo '正常';}else{echo '禁用';};?></td>
                    <td>2014.10.12</td>
                    <td>
                    	<a href="#" class="Editopration" data-id="<?php echo $item->userid;?>">编辑</a>
                    	<a href="#" class="Delopration" data-id="<?php echo $item->userid;?>">删除</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
            
        </div>
        <?php } ?>
    </li>
    <li>
     	<?php if($page->total_pages > 1) { ?>
    	<div class="xtulleft"><input type="button"  value="删除" class="XTOk" id="memberDelBtn"  /></div>
        <div class="xtulright">
          	<div class="xtRleft">总共有&nbsp;<span><?php echo $page->total_items;?></span>条</div>
            <div class="xtRcent">每条记录数&nbsp;<select class="xtrsele" id="selectPageSize"><?php echo $page->pageSizeOption;?></select></div>
		    <div class="xtRrighg">
		        <span><a href="#" class="inpubolr syspage" data="/system/member?page=1&pageSize=<?php echo $page->pageSize;?>" >首页</a></span>
		        <span><a href="#" class="inpubolr syspage" data="/system/member/?page=<?php echo $page->before;?>&pageSize=<?php echo $page->pageSize;?>" >上一页</a></span>
		        <?php echo $page->lists; ?>
		        <span><a href="#" class="inpubolr syspage" data="/system/member/?page=<?php echo $page->next;?>&pageSize=<?php echo $page->pageSize;?>">下一页</a></span>
		        <span><a href="#" class="inpubolr syspage" data="/system/member/?page=<?php echo $page->last;?>&pageSize=<?php echo $page->pageSize;?>">尾页</a></span>
		    </div>
             <div class="clear"></div>
        </div>
        <?php } ?>
        <div class="clear"></div>
    </li>
</ul>

<?php } ?>
