	$(document).ready(function() {
		// Store variables
		var accordion_head = $('.accordion > li > a'),
			accordion_body = $('.accordion li > .sub-menu'),
			accordion_a = $('.accordion li > .sub-menu > li > a');

		// Open the first tab on load
		/*
		accordion_head.first().addClass('active').next().slideDown('normal');
		// Click function
			accordion_head.on('click', function(event) {
//			var test = $(this);
//			for(i in test ){
//				 alert(i);           //获得属性 
//				 alert(test[i]);  //获得属性值
//			}
			// Disable header links
			event.preventDefault();
			// Show and hide the tabs on click
			if ($(this).attr('class') != 'active') {
				accordion_body.slideUp('normal');
				$(this).next().stop(true,true).slideToggle('normal');
				accordion_head.removeClass('active');
				$(this).addClass('active');
			}
			 window.location.href=$(this).context;

		});
		*/
		accordion_a.on('click', function(event) {
			
			var param = new String($(this).context);
			var data = param.split('#');

			$.ajax({
				url:'index/pathList?task=leftMenu&action='+data[1],
				dataType:'json',
				beforeSend:function(){
					$('.tools-left .msg').stop(true,true).fadeIn(100);
				},
				success:function(data){
					
					$('.tools-left .msg').fadeOut(100);
					if (!data.code) {	
						core.tips.tips(data);
						$(Config.FileBoxSelector).html('');
						return false;
					}
					G.json_data = data.data;
					G.this_path = param;
					
					_mainSetData(true);

					if (typeof(callback) == 'function'){
						callback(data);
					}
				},
				error:function(XMLHttpRequest, textStatus, errorThrown){					
					$('.tools-left .msg').fadeOut(100);
					$(Config.FileBoxSelector).html('');
					core.ajaxError(XMLHttpRequest, textStatus, errorThrown);
				}
			});
		});
		
	});
	
	function splitWithVar(str){
		
		var strs = new Array(); //定义一数组

		strs = str.split("#&"); //字符分割
		return strs;
	}
	
	//文件列表数据填充
	var _mainSetData = function(isFade){
		var html ="";//填充的数据
		var folderlist	= G.json_data['folderlist'];
		var filelist	= G.json_data['filelist'];
		//如果排序字段为size或ext时，文件夹排序方式按照文件名排序
		if (G.sort_field=='size' || G.sort_field=='ext' ){
			folderlist= folderlist.sort(_sortBy('name',G.sort_order));
		}else {
			folderlist= folderlist.sort(_sortBy(G.sort_field,G.sort_order));
		}
		filelist = filelist.sort(_sortBy(G.sort_field,G.sort_order));
		G.json_data['folderlist']=folderlist;
		G.json_data['filelist']=filelist;//同步到页面数据
		var file_function = '_getFileBox',
			folder_function = '_getFolderBox',
			file_html='',folder_html='';
		if (G.list_type=='list') {
			file_function   = '_getFileBoxList';
			folder_function = '_getFolderBoxList'
		}
		for (var i in filelist){
			file_html += this[file_function](filelist[i]);
		}
		for (var i in folderlist){
			folder_html += this[folder_function](folderlist[i]);
		}
		//end排序方式重组json数据------
		//升序时，都是文件夹在上，文件在下，各自按照字段排序		
		if (G.sort_order=='up'){
			html = folder_html+file_html;
		}else{
			html = file_html+folder_html;
		}

		if (html =='') html = '<div style="text-align:center;color:#aaa;">'+LNG.path_null+'</div>'
		html += "<div style='clear:both'></div>";
		//填充到dom中-----------------------------------
		if (isFade){//动画显示,
			$(Config.FileBoxSelector)
				.hide()
				.html(html)
				.fadeIn(Config.AnimateTime);
		}else{
			$(Config.FileBoxSelector).html(html);				
		}
		if (G.list_type=='list') {//列表奇偶行css设置
			$(Config.FileBoxSelector+" .file:nth-child(2n)").addClass('file2');
		}

	};
	
	//json 排序 filed:(string)排序字段，orderby:升降序。升序为-1，降序为1
	var _sortBy = function(filed,orderby) {
		var orderby = (orderby=='down')? -1 : 1;
		return function (a, b) {
			a = a[filed];
			b = b[filed];
			if (a < b) 	return orderby * -1;
			if (a > b) 	return orderby * 1;
		}
	}
	