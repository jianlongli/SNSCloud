<?php if($option == 'add') { ?>
	<?php echo $this->tag->stylesheetLink('./eduis/css/styletcs.css'); ?>
	<?php echo $this->tag->javascriptInclude('./eduis/js/jquery.min.js'); ?>
	<?php echo $this->tag->javascriptInclude('./static/js/lib/artDialog/jquery-artDialog.js?skin=default'); ?>
	<?php echo $this->tag->javascriptInclude('./circlestatic/js/_dev/src/explorer/common.js'); ?>
    <div class="DWgl">
    <div id="message" style="display:none;"></div>
    <form id='addCompanyForm' action='/system/company/add' method="POST">
  	<ul>
    	<li>
        	<div class="xtulleft">单位名称：</div>
            <div class="xtulright"><input type="text" name="name" class="xtrpsw"/><span  class="spancolor">*</span></div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">电话：</div>
            <div class="xtulright"><input type="text" name="phone" class="xtrpsw"/></div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulcent">
                 <input type="submit" value="保存" class="Okbutq" />
                 <input type="button" value="返回" class="Okbutq1" />
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
		
		$('#addCompanyForm').bind('submit',function(){
			$.common._ajax('addCompanyForm',addCompanyFormCallback);
			//art.dialog.close();
			return false;
		});
		
	});
	
	function addCompanyFormCallback( _data ){
		console.log(_data);
		if(!_data.code){
			$.common._showMsg ('message', _data.data);
		}else{
			$.common._showMsg ('message', _data.data);
			//art.dialog.close();
		}
	}
	
  </script>
<?php }else if($option =='edit'){ ?> 
	<?php echo $this->tag->stylesheetLink('./eduis/css/styletcs.css'); ?>
	<?php echo $this->tag->javascriptInclude('./eduis/js/jquery.min.js'); ?>
	<?php echo $this->tag->javascriptInclude('./static/js/lib/artDialog/jquery-artDialog.js?skin=default'); ?>
	<?php echo $this->tag->javascriptInclude('./circlestatic/js/_dev/src/explorer/common.js'); ?>
    <div class="DWgl">
    <div id="message" style="display:none;"></div>
    <form id='editCompanyForm' action='/system/company/edit' method="POST">
  	<ul>
    	<li>
        	<div class="xtulleft">单位名称：</div>
        	<input type="hidden" name="id" value="<?php echo $companyDetail->id;?>" />
            <div class="xtulright"><input type="text" name="name" class="xtrpsw" value="<?php echo $companyDetail->name;?>"/><span  class="spancolor">*</span></div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">电话：</div>
            <div class="xtulright"><input type="text" name="phone" class="xtrpsw" value="<?php echo $companyDetail->phone;?>"/></div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulcent">
                 <input type="submit" value="修改" class="Okbutq" />
                 <input type="button" value="返回" class="Okbutq1" />
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
		
		$('#editCompanyForm').bind('submit',function(){
			$.common._ajax('editCompanyForm',editCompanyFormCallback);
			//art.dialog.close();
			return false;
		});
		
	});
	
	function editCompanyFormCallback( _data ){
		console.log(_data);
		if(!_data.code){
			$.common._showMsg ('message', _data.data);
		}else{
			$.common._showMsg ('message', _data.data);
			//art.dialog.close();
		}
	}
	
  </script> 
<?php }else{ ?>
<ul>
	<li>
    	<div class="yqul">
         <span>单位名称:</span>
         <input type="hidden" class="inputText" id="keyWordH" value="<?php echo $page->key; ?>" />
          <span style="margin-left:20px;">区域:</span>
          <select class="xtrsele" id="regionalOption" ><?php echo $page->regionalOption;?></select>
          <input type="hidden" id="regionalOptionH" name="regionalOptionH" value="<?php echo $page->regional;?>" />
          <input type="text" class="xtrpsw" id="keyWord" value="<?php echo $page->key; ?>" />
		  <input type="button"  value="查询" class="XTOk Search"/>
        </div>
        <div class="clear"></div>
    </li>
    <li>
    	<div class="yqul">
    	<?php if($page){ ?>
            <table>
                <tr class="yqtr">
                	<td><input type="checkbox" class="check" id="chooseAll"/></td>
                    <td>单位名称</td>
                    <td style="display:none;">所属区域</td>
                    <td>电话</td>
                    <td>创建时间</td>
                    <td>人员数量</td>
                    <td>操作</td>
                </tr>
                <?php foreach($page->items as $item){ ?>
                <tr>
                	<td><input type="checkbox" class="check" name="chkItem[]"  value="<?php echo $item->id;?>" /></td>
                    <td style="text-align:left"><a href="#"> <?php echo $item->companyname;?> </a></td>
                    <td style="display:none;"><?php echo $item->regionalname;?></td>
                    <td><?php echo $item->phone;?></td>
                    <td><?php echo date('Y-m-d',$item->time);?></td>
                    <td><?php echo $item->num;?></td>
                    <td>
                    	<a href="#" class="editCompany" data-id="<?php echo $item->id;?>">编辑</a>
                    	<a href="#" class="Delopration"  data-id="<?php echo $item->id;?>">删除</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
            <?php } ?>
        </div>
    </li>
    <li>
    	<div class="xtulleft"><input type="button"  value="新增用户" class="XTOk companyManage" data="add" /></div>
    	<div class="xtulleft"><input type="button"  value="删除" class="XTOk Delopration" /></div>
    	<?php if($page->total_pages > 1) { ?>
        <div class="xtulright">
        	<div class="xtRleft">总共有&nbsp;<span><?php echo $page->total_items;?></span>条</div>
            <div class="xtRcent"><div style=" width:70px; height:2px; "></div></div>
            <div class="xtRrighg">
		        <span><a href="#" class="inpubolr syspage" data="/system/company" >首页</a></span>
		        <span><a href="#" class="inpubolr syspage" data="/system/company/?page=<?php echo $page->before;?>" >上一页</a></span>
		        <?php echo $page->lists; ?>
		        <span><a href="#" class="inpubolr syspage" data="/system/company/?page=<?php echo $page->next;?>">下一页</a></span>
		        <span><a href="#" class="inpubolr syspage" data="/system/company/?page=<?php echo $page->last;?>">尾页</a></span>
            </div>
             <div class="clear"></div>
        </div>
        <?php } ?>
        <div class="clear"></div>
    </li>
</ul>
<?php } ?>