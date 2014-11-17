<?php echo $this->tag->stylesheetLink('./eduis/css/styletcs.css'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/quanz.js'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/alertInfo.js'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/swfupload.js'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/swfupload.queue.js'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/fileprogress.js'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/handlers.js'); ?>
<?php echo $this->tag->javascriptInclude('./eduis/js/common.js'); ?>

<div class="Qx1">
    <div class="Qx11">通知名称：</div>
    <div class="Qx12"><input type="text" class="inputNam" /></div>
    <div class="clear"></div>
</div>
<div class="Qx1">
    <div class="Qx11">接收人：</div>
    <div class="Qx12">
    	<input type="radio" />圈内所有人　
        <input type="radio" />指定人　
         <input type="text" class="inputNam" />　
        <input type="button" value="选择接收人"  onclick=" $.alertUrl('选择接收人.html', '　选择接收人', 600, 400);" class="quanz" onMouseOver="this.className='Upquanz'" onMouseOut="this.className='Offquanz'"  />　
    </div>
    <div class="clear"></div>
</div>
 <div class="Qx1">
    <div class="Qx11">是否回执：</div>
    <div class="Qx12">
    	<input type="radio" />是　
        <input type="radio" />否　
     </div>
    <div class="clear"></div>
</div>
<div class="Qx1">
    <div class="Qx11">通知内容：</div>
    <div class="Qx12"><textarea class="textarea"></textarea></div>
    <div class="clear"></div>
</div>
<div class="Qx1">
    <div class="Qx11">通知附件：</div>
    <div class="Qx12">
        <input type="text" class="inputNam" />
        <input type="file" />
        <input type="button" value="添加"  class="xizbts"  onMouseOver="this.className='Upxizbts'" onMouseOut="this.className='Offxizbts'" />　
    </div>
    <div class="clear"></div>
</div>
<div class="Qx1">
    <div class="Qx11">　　　　</div>
    <div class="Qx12">
    	<input type="submit" value="确定" class="Okbut" onMouseOver="this.className='UpOkbut'" onMouseOut="this.className='OffOkbut'"  />
        <input type="submit" value="取消" class="Okbutqx" onMouseOver="this.className='UpOkbutqx'" onMouseOut="this.className='OffOkbutqx'"/>
    </div><br />
    <div class="clear"></div>
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
        <tr>
            <td  style="text-align:left;"><a href="#" style=" color:#00F;">通知1</a></td>
            <td>小芳</td>
            <td>是</td>
            <td>2014.09.01</td>
            <td>
              <input type="button" value="修改"  class="deletBut1"/>　　
              <input type="button" value="删除"  class="deletBut1"/>
            </td>
        </tr>
        <tr>
            <td  style="text-align:left;"><a href="#" style=" color:#00F;">通知1</a></td>
            <td>小芳</td>
            <td>否</td>
            <td>2014.09.01</td>
            <td>
              <input type="button" value="修改"  class="deletBut1"/>　　
              <input type="button" value="删除"  class="deletBut1"/>
            </td>
        </tr>
    </table>
    <div class="clear"></div>
</div>
 <div class="Qx1">
    <div class="Qx11">
    <input type="button" value="发布新通知"  class="quanz" onMouseOver="this.className='Upquanz'" onMouseOut="this.className='Offquanz'" onclick=" $.alertUrl('我的圈子-发布通知-发布新通知.html', '　发布新通知', 730, 500);" />
    </div>
    <div class="Qx12xy">
    	<input type="button" value="首页"  class="qxtbut1"/>
        <input type="button" value="上一页" class="qxtbut1"/>
        <input type="button" value="下一页" class="qxtbut1" />
        <input type="button" value="尾页"  class="qxtbut1"/>
    </div>
    <div class="clear"></div>
</div>