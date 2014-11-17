<?php echo $this->tag->stylesheetLink('./eduis/css/styletcs.css'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/jquery.min.js'); ?>
<?php echo $this->tag->javascriptInclude('./static/js/lib/artDialog/jquery-artDialog.js?skin=default'); ?>
<?php echo $this->tag->javascriptInclude('./circlestatic/js/_dev/src/explorer/common.js'); ?>

<?php if($option == 'update'){ ?>
  <?php if(isset($circleInfo) && count($circleInfo) > 0 && is_array($circleInfo)){ ?>
  <div class="QZgl">
  	<div id="message" style="display:none;"></div>
 	<form id="circleReviewForm" action="/sysmanage/circle/update" method="POST">
 	<input type="hidden" id="circleid" name="circleid" value="<?php echo $circleInfo['circleid']; ?>"/>
  	<ul>
    	<li>
        	<div class="xtulleft">圈子名称：</div>
            <div class="xtulright"><?php echo $circleInfo['circlename']; ?></div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">圈子介绍：</div>
            <div class="xtulright"><?php echo $circleInfo['des']; ?></div>
            <div class="clear"></div>
        </li>
        <li style="display:none;">
        	<div class="xtulleft">圈子分类：</div>
            <div class="xtulright"><input type="text" class="xtrpsw" /></div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">圈子LOGO：</div>
            <div class="xtulright"><div class="qzlogo"><img src="images/<?php echo $circleInfo['logo']; ?>" /></div></div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">圈主：</div>
            <div class="xtulright"><?php echo $circleInfo['member2']; ?></div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">专家：</div>
            <div class="xtulright"><?php echo $circleInfo['member3']; ?></div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">圈子管理员：</div>
            <div class="xtulright"><?php echo $circleInfo['member1']; ?></div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">圈员：</div>
            <div class="xtulright"><?php echo $circleInfo['member0']; ?></div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">审核意见：</div>
            <div class="xtulright"><span><input type="radio" name="status" id="status" value="1" checked="checked" />通过</span><span class="span"><input type="radio" name="status" id="status" value="0" />不通过</span></div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">意见内容：</div>
            <div class="xtulright"><textarea class="suggest" id="suggest" name="suggest"></textarea><br /><span class="span1">意见内容限制为2000字！</span></div>
            <div class="clear"></div>
        </li>
         <li>
        	<div class="xtulcent">
                 <input type="submit" value="确定" class="Okbutq"   />
                 <input type="reset" value="关闭" class="Okbutq1" />
         	</div>
        </li>
    </ul>
    </form>
  </div>
  <script>
    /*Circle review Form*/
    $(function(){
	 	$('#circleReviewForm').live('submit',function(){
	 		$("#suggest").val();
			$.common._ajax('circleReviewForm',circleReviewformCallback);
			return false;
		});   
    });

	function circleReviewformCallback( _data ){
		$.common._showMsg ('message', _data.data);
	}
	</script>
<?php }}else{ ?>

<?php if(isset($circleInfo) && count($circleInfo) > 0 && is_array($circleInfo)){ ?>
  <div class="QZjs">
  	<ul>
    	<li>
        	<div class="xtulleft">圈子名称：</div>
            <div class="xtulright"><?php echo $circleInfo['circlename']; ?></div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">圈子介绍：</div>
            <div class="xtulright"><?php echo $circleInfo['des']; ?></div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">圈子LOGO：</div>
            <div class="xtulright"><div class="qzlogo"><img src="images/<?php echo $circleInfo['logo']; ?>" /></div></div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">圈主：</div>
            <div class="xtulright"><?php echo $circleInfo['member2']; ?></div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">专家：</div>
            <div class="xtulright"><?php echo $circleInfo['member3']; ?></div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">圈子管理员：</div>
            <div class="xtulright"><?php echo $circleInfo['member1']; ?></div>
            <div class="clear"></div>
        </li>
        <li>
        	<div class="xtulleft">圈员：</div>
            <div class="xtulright"><?php echo $circleInfo['member0']; ?></div>
            <div class="clear"></div>
        </li>
    </ul>
  </div>
  
  <?php }} ?>
  
  

  
