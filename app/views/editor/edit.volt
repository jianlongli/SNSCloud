<?php
/*
	$htmlData = '';
	if (!empty($_POST['content'])) {
		if (get_magic_quotes_gpc()) {
			$htmlData = stripslashes($_POST['content']);
		} else {
			$htmlData = $_POST['content1'];
		}
	}
	*/
?>

    {{ javascript_include('../../kindeditor-4.1.10/kindeditor-min.js') }}
    {{ javascript_include('../../kindeditor-4.1.10/lang/zh_CN.js') }}
	
	<script>
		KindEditor.ready(function(K) {
				K.each({
					'plug-align' : {
						name : '对齐方式',
						method : {
							'justifyleft' : '左对齐',
							'justifycenter' : '居中对齐',
							'justifyright' : '右对齐'
						}
					},
					'plug-order' : {
						name : '编号',
						method : {
							'insertorderedlist' : '数字编号',
							'insertunorderedlist' : '项目编号'
						}
					},
					'plug-indent' : {
						name : '缩进',
						method : {
							'indent' : '向右缩进',
							'outdent' : '向左缩进'
						}
					}
				},function( pluginName, pluginData ){
					var lang = {};
					lang[pluginName] = pluginData.name;
					KindEditor.lang( lang );
					KindEditor.plugin( pluginName, function(K) {
						var self = this;
						self.clickToolbar( pluginName, function() {
							var menu = self.createMenu({
									name : pluginName,
									width : pluginData.width || 100
								});
							K.each( pluginData.method, function( i, v ){
								menu.addItem({
									title : v,
									checked : false,
									iconClass : pluginName+'-'+i,
									click : function() {
										self.exec(i).hideMenu();
									}
								});
							})
						});
					});
				});
				K.create('#contentqq', {
					themeType : 'qq',
					items : [
						'bold','italic','underline','fontname','fontsize','forecolor','hilitecolor','plug-align','plug-order','plug-indent','link'
					]
				});
			});
		</script>

	<form name="example" method="post" action="<?php echo $HOST_NAME;?>/editor/filesave">
		<textarea id="contentqq" name="content" style="width:700px;height:200px;visibility:hidden;"><?php echo htmlspecialchars($htmlData['content']); ?></textarea>
		<input type="hidden" name="charset" value="<?php echo $htmlData['charset'];?>" id="charset"/> 
		<input type="hidden" name="path" value="<?php echo $htmlData['filename'];?>" id="path"/> 
		<br />
		<input type="submit" name="button" value="提交内容" /> (提交快捷键: Ctrl + Enter)
	</form>


