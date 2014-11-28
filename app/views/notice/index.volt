<?php echo $this->tag->stylesheetLink('./circlestatic/css/styletcs.css'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/jquery.min.js'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/_dev/src/explorer/common.js'); ?>
<?php echo $this->tag->javascriptInclude("./circlestatic/js/lib/artDialog/jquery-artDialog.js?skin=default");?>
<?php echo $this->tag->javascriptInclude('./eduis/js/alertInfo1.js'); ?>


<script language="javascript">
	$(function(){
		$("#viewNotice").live('click' , function(){
			$.ajax({
				url : '/notice/read?id='+$(this).data('id'),
				success : function(data){
				}
			});	
			art.dialog.open('/notice/look/'+ $(this).data('id') + '?manage=' + $(this).data('manage') , {
                fixed : true,
                title : '查看通知',
                lock : true,
                height : '500px',
                width : '930px',
	        });
		});
		
		$("#editNotice").live('click' , function(){
			art.dialog.open('/notice/edit/'+ $(this).data('id') , {
                fixed : true,
                title : '编辑通知',
                lock : true,
                height : '500px',
                width : '930px',
	        });			
		});
	});
/*
 function onClick (id) {
  window.open(id,"选择接收人","height=600, width=600, top=100,left=300,toolbar =no, menubar=no, scrollbars=yes, resizable=no, location=no, status=no");
 }
 function setData (name) {

  if(document.getElementById('receive_people').value!=""){
    document.getElementById('receive_people').value+=","+name;
  }else{
   document.getElementById('receive_people').value=name;
  }
 }
 */
 
 function loud_receive(url){
	$("#receivetype_n").attr("checked",true);
	$.alertUrl(url, '选择接收人', 610, 500);
}
</script>
<?php if($isManager){ ?>
{{ form('notice/send', 'id': 'noticeForm','enctype':'multipart/form-data') }}	                
	<input type="hidden" name="id" value="<?php echo $circle_id;?>" />
	<div class="Qx1">
	    <div class="Qx11">通知名称：</div><input type="hidden" name="circle_id" value="<?php echo $circle_id?>">
	    <div class="Qx12"><input type="text" class="inputNam" id="notice_title" name="notice_title" placeholder="标题" required /></div>
	    <div class="clear"></div>
	</div>
	
    <div class="Qx1">
        <div class="Qx11">接收人：</div>
        <div class="Qx12">
        	<!--<input type="radio" name="receive" checked value="0" />圈内所有人　
            <input type="radio" name="receive" value="1"/>指定人　
             <input type="text" class="inputNam" name="receive_people" id="receive_people" value=""/>
            <input type="button" value="选择接收人"  onclick="onClick('received/{{circle_id}}');" class="quanz" onMouseOver="this.className='Upquanz'" onMouseOut="this.className='Offquanz'"  />　-->
			
			<label><input type="Radio" name="receivetype" id="receivetype_y" value="Y" checked/>圈内所有人</label>
                                    	<label><input type="Radio" name="receivetype" id="receivetype_n"  value="N" />指定人</label>
										<input type="text" class="inputNam" id="receiveid" disabled=disabled />　
										<input name="hdreceiveid" id="hdreceiveid" type="hidden" value="" />
										<input type="button" value="选择接收人" onclick="loud_receive('/work/receive/?circleid=<?php echo $circle_id?>');" class="quanz" onMouseOver="this.className='Upquanz'" onMouseOut="this.className='Offquanz'" />
										
        </div>
        <div class="clear"></div>
    </div>
     <div class="Qx1">
        <div class="Qx11">是否回执：</div>
        <div class="Qx12">
        	<input type="radio" name ="back" value="1" checked/>是　
            <input type="radio" name="back" value="0"/>否　
         </div>
        <div class="clear"></div>
    </div>
    <div class="Qx1">
        <div class="Qx11">通知内容：</div>
        <div class="Qx12"><textarea name="content" class="textarea" placeholder="请填写通知内容" required></textarea></div>
        <div class="clear"></div>
    </div>
    <div class="Qx1">
        <div class="Qx11">通知附件：</div>
        <div class="Qx12">
           <input type="file" name="notice_fujian" value=""/>
           <!-- <input type="button" value="添加"  class="xizbts"  onMouseOver="this.className='Upxizbts'" onMouseOut="this.className='Offxizbts'" />　-->
        </div>
        <div class="clear"></div>
    </div>
    <div class="Qx1">
        <div class="Qx11">　　　　</div>
        <div class="Qx12">
         {{ submit_button('确定', 'class': 'Okbut', 'onclick': 'return SignUp.validate();','onMouseOver':'return this.className="UpOkbut"','onMouseOut':'return this.className="OffOkbut"') }}
            <input type="reset" value="取消" class="Okbutqx" onMouseOver="this.className='UpOkbutqx'" onMouseOut="this.className='OffOkbutqx'"/>
        </div><br />
        <div class="clear"></div>
        </from>
     </div>
     <div class="Qx1">
        <div class="Qx11"></div>
        <div class="Qx12">已发布的通知：</div>
        <div class="clear"></div>
    </div>
                                
                              
    <div class="Qx1">
		<table width="800" class="tztable">
	       <tr class="tabletr">
	            <td>通知名称</td>
	            <td>接收人</td>
	            <td>回执</td>
	            <td width="200">发布时间</td>
	            <td width="150">操作</td>
	        </tr>   
	                               
	        <?php foreach($page->items as $product){ ?>                              
				<tr>
	                <td  style="text-align:left;"><a href="#" style=" color:#00F;"><?php echo $product->notice_title;?></a></td>
	                <?php $targetUser = $product->receive_people == 0 ? '圈子所有人' : '指定人';?>
	                <td><?php echo $targetUser;?></td>
	                <?php $isback = $product->back == 0 ? '否' : '是';?>
	                <td><?php echo $isback;?></td>
	                <td><?php echo $product->add_time;?></td>
	                <td>   
	                	<a href="javascript:;" id="viewNotice" data-id="<?php echo $product->notice_id;?>" data-manage="<?php echo $isManager;?>">查看通知</a>
	                	<a href="javascript:;" id="editNotice" data-id="<?php echo $product->notice_id;?>">修改通知</a>
	                	<a href="#">删除</a>
                    </td>
                    
                </tr>	
            <?php } ?>
		</table>
	<div class="clear"></div>
	</div>
	</form>
<?php }else{ ?>

    <div class="Qx1">
		<table width="800" class="tztable">
	       <tr class="tabletr">
	            <td>通知名称</td>
	            <td width="200">发布时间</td>
	            <td width="150">操作</td>
	        </tr>   
	                               
	        <?php foreach($page->items as $product){ ?>                              
		<tr>
	                <td  style="text-align:left;"><a href="#" style=" color:#00F;"><?php echo $product->notice_title;?></a></td>
	                <td><?php echo $product->add_time;?></td>
			<td>
	                	<a href="javascript:;" id="viewNotice" data-id="<?php echo $product->notice_id;?>" data-manage="<?php echo $isManager;?>">查看通知</a>
			</td>
                    
                </tr>	
            <?php } ?>
		</table>
	<div class="clear"></div>
	</div>
<?php } ?>
    
	<div class="Qx1">
         <div class="Qx11"></div>
         <div class="Qx12xy">
	        {{ link_to("notice/index?id="~circle_id, '<i class="icon-fast-backward"></i> 首页', "class": "qxtbut1") }}
	        {{ link_to("notice/index?id="~circle_id~"&page=" ~ page.before, '<i class="icon-step-backward"></i> 上一页', "class": "qxtbut1") }}
	        {{ link_to("notice/index?id="~circle_id~"&page=" ~ page.next, '<i class="icon-step-forward"></i> 下一页', "class": "qxtbut1") }}
	        {{ link_to("notice/index?id="~circle_id~"&page=" ~ page.last, '<i class="icon-fast-forward"></i> 尾页', "class": "qxtbut1") }}
	        <span class="help-inline">{{ page.current }} of {{ page.total_pages }}</span>
        </div>
        <div class="clear"></div>
	</div>
                                
             


