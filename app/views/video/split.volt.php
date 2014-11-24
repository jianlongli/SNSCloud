<?php echo $this->tag->stylesheetLink('./new/css/style.css'); ?>
<?php echo $this->tag->javascriptInclude('./new/js/jquery-1.9.1.js'); ?>
<?php echo $this->tag->javascriptInclude('./new/js/alertInfo.js'); ?>
<?php echo $this->tag->javascriptInclude('./new/script/jquery.js'); ?>
<?php echo $this->tag->javascriptInclude('./new/script/dianji.js'); ?>
<!--加减号折叠菜单-->
<script language="JavaScript">
<!--
function showLay(divId){
	var objDiv = eval(divId);
	if (objDiv.style.display=="none"){
		eval("sp"+divId+".innerHTML='-'");
		objDiv.style.display="";
	}else{
		eval("sp"+divId+".innerHTML='+'");
		objDiv.style.display="none";
	}
}
// -->
</script>
<?php echo $this->tag->javascriptInclude('./new/jwplayer/jwplayer.js'); ?>
<?php echo $this->tag->javascriptInclude('./new/jwplayer/jquery-1.6.1.min.js'); ?>
    <script language="JavaScript">
        var thePlayer;  //保存当前播放器以便操作    
        $(function() {
            thePlayer = jwplayer('diocMLCont').setup({
			
		        flashplayer: '../../../public/new/jwplayer/player.swf',
                file:'../../../<?php echo $file_url;?>',
			//	image:'aa.jpg',
				autostart:true,
                volume:50,
                width: 750,
                height: 350,
				abouttext:'教育即',
                aboutlink:'',
				title:"教育即",
				//duration:50,//持续时间
                dock: false,
				controlbar: 'bottom'

            });
            //选择起点播放时间
            $('#start').click(function() {
           
            var start =formatSeconds(thePlayer.getPosition());
            $('#startTime').val(start);
          
             thePlayer.play(false);
              });
              
            //选择终点播放时间
            $('#end').click(function() {
           
            var end =formatSeconds(thePlayer.getPosition());
            $('#endTime').val(end);
                    
             thePlayer.play(false);
              });
              //发表评论----start
              $("#fabiaopinglun").click(function(){	
                   var pinglun=$("#pinglun").val();
                   if(pinglun ==""){
                   
                   alert("请填写内容");return;
                   }
                   var file_id=$("#file_id").val();
            	   var qiepian_id=$("#qiepian_id").val();
              	   var query ='pingluns='+pinglun+"&file_id="+file_id+"&qiepian_id="+qiepian_id;
	              $.ajax({
		                 type: "post",
		                 url: "pinglun",
		                 data: query,
		                 success: function(data){
		              
				                  var arr = new Array();
								arr = data.split("@#*");
								if(arr[1]=="error"){
									alert("发表失败");return;
								}else{
								    alert("发表成功");
		                            $("#pinglun").val("");
			                    }    
		                      
		                 },
		                 error:function(data){alert("发表失败");}
	           		  });
              		
              
              });
              
              //发表评论----end
              
              //下载文件 --- start
              $('#download').click(function(){
              	//alert("fdasf");
              var url="../../../<?php echo $file_url;?>";
		        window.location.href="down?url="+url;      	
              });
              
             //下载文件 --- end
             
            
             //点击推荐 ---start
             $('#tuijian').click(function(){
                 
               var file_id=$("#file_id").val();
               var qiepian_id=$("#qiepian_id").val();
               
               var query="file_id="+file_id+"&qiepian_id="+qiepian_id;
             	 $.ajax({
	                 type: "post",
	                 url: "tuijian",
	                 data: query,
	                 success: function(data){
	                
	                  var arr = new Array();
						arr = data.split("@#*");
						if(arr[1]=="error"){
							alert("已经推荐过，谢谢参与");return;
						}else{
						   var num= parseInt($("#tujian_count").text());
						     $("#tujian_count").text(num+1);
	                         alert("推荐成功，谢谢参与");return; 
	                    }             
	                 },
	                 error:function(data){alert("推荐失败");}
           		  });
             });
             
            // 点击推荐 --end
            //提交
           $('#sub').click(function() {
      
               var one=$("#startTime").val();
               var two=$("#endTime").val();
               var content=$("#content").val();
               var file_id=$("#file_id").val();
               var keyVal= $("#videoName").val();  
               
               if(start==undefined || start=="" || start==null){
                    alert("起点不能为空");return;
               }
               if(end==undefined || end=="" || end==null){
                    alert("终点不能为空");return;
               }
               
               if(one >= two){
                   alert("终点时间不能小于或等于起点时间");return;
               
               }
		      
			    if(keyVal==undefined || keyVal=="" || keyVal==null){  
			         alert("名称不能为空");  return;
			    }  
			    if(keyVal.length>6){  
                     alert("名称不能大于六个");  return;
					} 
					
					var query="one="+one+"&two="+two+"&content="+content+"&file_id="+file_id+"&name="+keyVal;
				if(window.confirm('你确定要保存该切片么？')){
				  
				    $.ajax({
	                 type: "post",
	                 url: "send",
	                 data: query,
	                 success: function(data){
	                 
	                 
	                    var arr = new Array();
						arr = data.split("@#*");
						if(arr[1]=="error"){
							alert("添加失败");return;
						}else{
						
	                $("#qiepian").append('<li class="voc_mlikl"><span class="voc_spans" onclick="sub(\''+one+'\',\''+two+'\',\''+arr[1]+'\');">'+keyVal+'</span><span><label>'+one+'</label>-<label>'+two+'</label></span></li>');
	                $("#qiepian").append('<li>'+content+'</li>');
	                $("#qiepian").append('<li class="voc_bottbored"></li>');
	                 
	                  alert("添加成功"); 
	                  }
	                                 
	                 },
	                 error:function(data){alert("添加失败");}
	                }); 
				
				    
				}else{
				
				  return false;
				}	
		
           });
                
              
      
            //获取视频长度     thePlayer.getDuration()
         
        });
	
    //跳到制定时间播放
    //点击删除 ---start
		function del(id){
		  if(window.confirm('你确定要删除此切片视频么？')){	
		   
		  		$.ajax({
		  			type:"post",
		  			url:"del",
		  			data:"id="+id,
		  			success: function(data){
		  		
		  			$("#"+id+"ok").remove();		
		  			$("#"+id+"okk").remove();	  			
		  			}
		  		
		  		});
		  }
	   }
	//点击删除---end

		//跳到制定时间播放
		function sub(a,b,v){
		var array = a.split(":");
		var start ="";
		var i= array.length;
		
		if(i==3){
		
		 start=parseInt(array[0]*3600)+parseInt(array[1]*60)+parseInt(array[2]);
		}else{
		
		 start=parseInt(array[0]*60)+parseInt(array[1]);
		}
		
		var arrays = b.split(":");
		var end ="";
		var i= arrays.length;
		
		if(i==3){
		
		 end=parseInt(arrays[0]*3600)+parseInt(arrays[1]*60)+parseInt(arrays[2]);
		}else{
		
		 end=parseInt(arrays[0]*60)+parseInt(arrays[1]);
		}
		
		var a=start;
		var b=end;
		    $("#xianshi").text("");
	       var keyVal= $("#"+v+"").html(); 
	       $("#xianshi").html(keyVal);
	     
	      $("#qiepian_id").val(v);
			var c=(b-a)*1000;

			if (thePlayer.getState() != 'PLAYING') {    //若当前未播放，先启动播放器
                    thePlayer.play();
                }
				thePlayer.seek(a);
				setTimeout("thePlayer.stop()", c);
				thePlayer.always = true; //循环播放
				var query="video_id="+v;
				 $.ajax({
	                 type: "post",
	                 url: "tuijian",
	                 data: query,
	                 success: function(data){
	                
	                  var arr = new Array();
						arr = data.split("@#*");
						$("#tujian_count").text(arr[1]);
	                   
	                             
	                 },
	                 error:function(data){alert("请求错误");}
           		  });
		}
		

  //时间转换		
		function formatSeconds(value) {

		    var theTime = parseInt(value);// 秒		
		    var theTime1 = 0;// 分
		    var theTime2 = 0;// 小时
		
		   if(theTime > 60) {		
		        theTime1 = parseInt(theTime/60);		
		        theTime = parseInt(theTime%60);
		         if(theTime1 > 60) {
          			  theTime2 = parseInt(theTime1/60);
          			  theTime1 = parseInt(theTime1%60);
          		}
		
		    } 
				    
			var result =theTime;
			if(result<10){ result ="0"+result;}
			if(theTime1 > 0) {
			   if(theTime1<10){ theTime1 = "0"+theTime1;}
			   result =theTime1+":"+result;
				
			 }else{
			 
			   result="00:"+result;
			 }
				
			 if(theTime2 > 0) {
				 if(theTime2<10){theTime2 ="0"+theTime2;}
				  result =theTime2+":"+result;
			 }
						 
			 return result;

		}
		
		
    </script>

    <div class="docmidde">
    	<!--左侧内容-->
    	<div class="docMLeft">
        	<!--头-->
            <div class="doctop">
                <h2>2014小学教育研讨会发言稿</h2>
                <ul>
                	<li>上传者：<span>熊成军</span></li>
                    <li style="width:125px;overflow: hidden; text-overflow:ellipsis;white-space:nowrap; ">学校：
                    	<span style="size:8px;">北京和平街一中</span>
                    </li>
                    <li>大小：<span>120MB</span></li>
                    <li>上传时间：<span class="lifontbo">2014年05月03日</span></li>
                    <li><div><img src="../../public/new/images/y2.png" /></div>浏览：<span>11</span></li>
                    <li><div class="divst"><img src="../../public/new/images/y3.png" /></div>下载：<span>9</span></li>
                </ul>
            </div>
            <!-- 视频存放位置-->
            
            <div style="position:absolute; left:280px; top:350px; z-index:999; width:600px;color:yellow;hight:100px;" id="xianshi"><?php echo $zhuanjiapinglun; ?></div>
            
            <div class="diocMLCont" style="position:relative;" id="diocMLCont">
            	<object name="diocMLCont" width="100%" height="90%" id="diocMLCont" >
					<param name="movie" value="../../public/new/jwplayer/player.swf">
					<param name="src" value="../../public/new/jwplayer/player.swf">
					<param name="AllowScriptAccess" value="always">
				</object>
            </div>
            <div class="docBLeft">
                <h4>专家评论</h4>
                <div class="docBLeft1">
                	<ul><input type="hidden" name="file_id" id="file_id" value="<?php echo $file_id; ?>">
                    	<li><img src="../../public/new/images/tt1.png" /></li>
                        <li><textarea id="pinglun" name="pinglun"></textarea></li>
                        <input type="hidden" name="qiepian_id" id="qiepian_id" value="">
                        <li><input type="submit" value="发表评论"  class="leftbotn" id="fabiaopinglun"/></li>
                        <li><input type="button" value="推荐"  class="leftbotn1" id="tuijian"/>&nbsp;<label id="tujian_count"><?php echo $tuijian; ?></label>次</li>
                    </ul>
                </div>
                <h4 >相关推荐</h4>
                <div class="docBLeft2">
                	<ul>
                    	<li><a href="#">教育研究均衡化</a></li>
                        <li><a href="#">教育研究均衡化</a></li>
                        <li><a href="#">教育研究均衡化</a></li>
                        <li><a href="#">教育研究均衡化</a></li>
                        <li><a href="#">教育研究均衡化</a></li>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        
        <!--右侧内容-->
        <div class="docMRight">
        	<!--添加视频切片-->
        	<div class="doc_Tspq">
            	<h5>添加视频切片</h5>
                <ul>
                	<li>
                        <div class="docTs_left">起点：<input type="text" class="Tsp_input" id="startTime" name="startTime"/>
                        <input type="hidden" class="Tsp_input" id="file_id" name="file_id" value="<?php echo $file_id; ?>"/></div>
                        <div class="Ts_div"><input type="button"  value="选择起点" class="Tsp_buton" id="start"/></div>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <div class="docTs_left">终点：<input type="text" class="Tsp_input" id="endTime" name="endTime"/>
                    
                        <div class="Ts_div"><input type="button" value="选择终点" class="Tsp_buton" id="end"/></div>
                        <div class="clear"></div>
                    </li>
                    <li>名称：<input type="text" class="Tsp_input1" name="videoName" id="videoName"/><span style="font-size:11px;">(最长6个字)</span></li>
                    <li><div class="docTs_bottom">说明：</div><textarea class="Tsp_textarea" id="content" name="content"></textarea></li>
                    <li class="docTs_cent"><input type="button" value="新增切片" class="Tsp_buton1" id="sub"/></li>
                </ul>
                <div class="clear"></div>
            </div>
        	<div class="docMRight11"><input type="button" value="分享此文件" class="MRbut1" /></div> 
            <div class="docMRight2">
             <div class="docMRight2top"></div>
             <div class="docMRight2cent">
            	<div class="docMRight22"></div>
            	 <!--点击隐藏开始-->
            	 <div class="vtitle"><em class="v v02"></em>上交作业<span>23</span></div>
                 <div class="vocn">
                 	<div class="vocntop"></div>
                    <div class="vconmidde" >
                        <ul >
                          <li class="select">
                          	<div><a href="javascript:;" onclick="showLay('Layer1')"><span id="spLayer1">+</span>小学语文第五文第五册文第五册册</a></div>
                            <div id="Layer1" style="display:none;">
                            	<ul>
                                	<li>微课在品德学科</li>
                                    <li><input type="button" value="交作业" class="xizbt1" onMouseOver="this.className='Upxizbt1'" onMouseOut="this.className='Offxizbt1'" onclick=" $.alertUrl('我的圈子-作业管理-我的作业.html', '　我的作业', 900, 500);"/>
                                	</li>
                                    <li>生效日期:<span>201.9.12</span></li>
                                    <li>失效日期:<span>201.9.18</span></li>
                                </ul>
                            </div>
                          </li>
                          
                          <li>
                          	<div><a href="javascript:;" onclick="showLay('Layer2')"><span id="spLayer2">+</span>小学语文第五文第五册文第五册册</a></div>
                            <div id="Layer2" style="display:none;">
                            	<ul>
                                	<li>微课在品德学科</li>
                                    <li><input type="button" value="已交" class="xizbt1j" onMouseOver="this.className='Upxizbt1j'" onMouseOut="this.className='Offxizbt1j'" onclick=" $.alertUrl('我的圈子-作业管理-我的作业.html', '　我的作业', 900, 500);"/>
                                	</li>
                                    <li>生效日期:<span>201.9.12</span></li>
                                    <li>失效日期:<span>201.9.18</span></li>
                                </ul>
                            </div>
                          </li>
                          <li>
                          	<div><a href="javascript:;" onclick="showLay('Layer3')"><span id="spLayer3">+</span>小学语文第五文第五册文第五册册</a></div>
                            <div id="Layer3" style="display:none;">
                            	<ul>
                                	<li>微课在品德学科</li>
                                    <li><input type="button" value="已过期" class="xizbt1g" onMouseOver="this.className='Upxizbt1g'" onMouseOut="this.className='Offxizbt1g'" onclick=" $.alertUrl('我的圈子-作业管理-我的作业.html', '　我的作业', 900, 500);"/>
                                	</li>
                                    <li>生效日期:<span>201.9.12</span></li>
                                    <li>失效日期:<span>201.9.18</span></li>
                                </ul>
                            </div>
                            <div class="clear"></div>
                          </li>
                          <li><a href="javascript:;">小学语文第五册</a></li>
                        </ul>
                     </div>
                    <div class="vocnbottom"></div>
                </div>
                <!--点击隐藏结束-->
                <!--点击隐藏开始-->
                <div class="vtitle"><em class="v"></em>课例切片</div>
                 <div class="vocn" style="display: none;">
                 	<div class="vocntop"></div>
                    <div class="vconmidde" id="jubu">
                    	<ul  id="qiepian">
                    	                             
                    	<?php foreach ($page as $product) { ?>
                    	
                          <li class="voc_mlikl" id="<?php echo $product->video_id; ?>ok"><input type="button" value="<?php echo $product->video_name; ?>"  class="wy_buys1" onclick="sub('<?php echo $product->video_start; ?>','<?php echo $product->video_end; ?>',<?php echo $product->video_id; ?>);" />
                          <input type="button"  value="删除" onclick="del(<?php echo $product->video_id; ?>);"  class="xizbt1" onMouseOver="this.className='Upxizbt1'" onMouseOut="this.className='Offxizbt1'"/><br /><label><?php echo $product->video_start; ?></label>-<label><?php echo $product->video_end; ?></label></li>
                           <li class="voc_bottbored"  id="<?php echo $product->video_id; ?>okk"><?php echo $product->video_description; ?></li>
                         <?php echo $qita; ?>
                        <?php } ?>
                          
                         </ul>
                        <!--<div class="vconM_info">
                        
                        
                          <div class="vov_f" id="split">
                          	<div class="vocn_left">重难点突破</div>
                            <div class="vocn_right">我认为介绍得很详细</div>
                            <div class="clear"></div>
                          </div>
                          <div class="vov_f">
                          	<div class="vocn_left">重难点突破</div>
                            <div class="vocn_right">还不错</div>
                            <div class="clear"></div>
                          </div>
                          
                          
                        </div>-->
                     </div>
                    <div class="vocnbottom"></div>
                </div>
                <!--点击隐藏结束-->
                <!--点击隐藏开始-->
            	 <div class="vtitle"><em class="v"></em>获得评论<span>23</span></div>
                 <div class="vocn" style="display: none;">
                 	<div class="vocntop"></div>
                    <div class="vconmidde" >
                        <ul >
                          <li class="voc_mlikl">很好，不错</li>
                          <li><label style="margin-right:4px; float:left;">高阳</label>从《<label>视频汇聚</label>》评论</li>
                          <li class="voc_bottbored"></li>
                          <li class="voc_mlikl">学生创作得很好</li>
                          <li><label style="margin-right:4px; float:left;">高阳</label>从《<label>语文圈</label>》评论</li>
                          <li class="voc_bottbored"></li>
                        </ul>
                     </div>
                    <div class="vocnbottom"></div>
                </div>
                <!--点击隐藏结束-->
                <!--点击隐藏开始-->
            	 <div class="vtitle"><em class="v"></em>资源轨迹</div>
                 <div class="vocn" style="display: none;">
                 	<div class="vocntop"></div>
                    <div class="vconmidde" >
                        <ul >
                          <li class="select"><a href="javascript:;"><span class="voc_spans">10-31</span>张三下载了此资源</a></li>
                          <li><a href="javascript:;"><span class="voc_spans">11-31</span>张三下载了此资源</a></li>
                          <li><a href="javascript:;"><span class="voc_spans">12-31</span>张三下载了此资源</a></li>
                        </ul>
                     </div>
                    <div class="vocnbottom"></div>
                </div>
                <!--点击隐藏结束-->
                 <!--点击隐藏开始-->
            	 <div class="vtitle"><em class="v"></em>专家评论<span>23</span></div>
                 <div class="vocn" style="display: none;">
                 	<div class="vocntop"></div>
                    <div class="vconmidde" >
                        <ul >
                          <li class="voc_mlikl">很好，不错</li>
                          <li><label style="margin-right:4px; float:left;">高阳</label>从《<label>视频汇聚</label>》评论</li>
                          <li class="voc_bottbored"></li>
                          <li class="voc_mlikl">学生创作得很好</li>
                          <li><label style="margin-right:4px; float:left;">高阳</label>从《<label>语文圈</label>》评论</li>
                          <li class="voc_bottbored"></li>
                        </ul>
                     </div>
                    <div class="vocnbottom"></div>
                </div>
                <!--点击隐藏结束-->
                 <!--点击隐藏开始-->
            	 <div class="vtitle"><em class="v"></em>相关资源</div>
                 <div class="vocn" style="display: none;">
                 	<div class="vocntop"></div>
                    <div class="vconmidde" >
                        <ul >
                          <li class="select"><a href="javascript:;">教育化信息管理</a></li>
                          <li><a href="javascript:;">教育改革高峰论坛记要</a></li>
                          <li><a href="javascript:;">教育公平化研究</a></li>
                        </ul>
                     </div>
                    <div class="vocnbottom"></div>
                </div>
                <!--点击隐藏结束-->
                <div style="text-align:center;clear:both"></div>
                </div>
                <div class="docMRight2bottom"></div>
                </div>
                <div class="docMRight11"><input type="button" value="下载此文件" class="MRbut2" id="download"/></div> 
                <div class="docMRight11"><input type="button" value="生成下载链接" class="MRbut3" /></div> 
                <!--<div class="docMRight1"><a href="#">下载此文件</a></div>
           		 <div class="docMRight12"><a href="#">生成下载链接</a></div>-->
            </div>            
             <div class="clear"></div>
        </div>        
    </div>
 <!--滚动条-->
<?php echo $this->tag->javascriptInclude('./new/js/gudjs/jquery.min.js'); ?>
<?php echo $this->tag->javascriptInclude('./new/js/gudjs/jquery.nicescroll.js'); ?>
<script type="text/javascript">
$(".vconmidde").niceScroll({  
	cursorcolor:"#fd0958",  
	cursoropacitymax:1,  
	touchbehavior:false,  
	cursorwidth:"7px",  
	cursorborder:"0",  
	cursorborderradius:"5px"  
}); 
</script>

