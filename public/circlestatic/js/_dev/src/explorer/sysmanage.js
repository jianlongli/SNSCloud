$.sysmanage ={
		
		/*默认加载方法*/
		_init : function (_action){
			var _allowAction = ['personal','invite','member','company','customer','circle','setting','log'];
			if ($.inArray(_action , _allowAction) === -1)
				_action = 'personal';
			this._getData ('sysmanage/'+_action , _action);
		},
		
		/* Get data*/
		_getData : function (_url , _key ,_param){
			if( typeof(_param) == 'undefined'){
				_param = {};
			}
			$.each(_param, function(i,n){
				console.log(i + '---------' + n);
			})
			
			var _content = '';
			
			$.ajax({
				url : _url,
				dataType : 'json',
				data : _param,
				beforeSend: function(){},
				success : function (_data){
					switch(_key){
						case 'invite': 
							_content = $.sysmanage._invitePage( _data ); break;
						case 'member':  
							_content = $.sysmanage._memberPage( _data ); break;
						case 'company': 
							_content = $.sysmanage._companyPage(_data ); break;
						case 'customer': 
							_content = $.sysmanage._customerPage(); break;
						case 'circle' :
							_content = $.sysmanage._circlePage( _data );break;
						case 'setting':
							_content = $.sysmanage._settingPage(); break;
						case 'log':
							_content = $.sysmanage._logPage(); break;
						default :
							_content = $.sysmanage._personalPage(_data.data); break;
					}
					
					$(".XTglInfodiv").html(_content);
				},
				error : function (){
					alert('error');
				}
			});
		},
		
		/*Delete data*/
		_delData : function ( _action , _id , _callback ){
			var _allowAction = ['member','circle','company'];
			if ($.inArray(_action , _allowAction) === -1){
				alert('Illegal request');return false;
			}
			
			if (_action && _callback && _id) {
				$.ajax({
					url : 'sysmanage/'+ _action +'/del',
					data : { 'id':_id },
					dataType : 'json',
					type : "POST",
					success : function ( _data ){
						_callback(_data);
					},
					error : function (_data ) {
						_callback(_data);
					}
				});
			}
		},
		
		/*Edit data*/
		_updateData : function ( _action , _param , _callback ){
			
			var _allowAction = ['member','circle','invite'];
			if ($.inArray(_action , _allowAction) === -1){
				alert('Illegal request');return false;
			}
			
			
			
			if (_action && _callback && _param) {
				$.ajax({
					url : 'sysmanage/'+ _action +'/update',
					data : _param,
					dataType : 'json',
					type : "POST",
					success : function ( _data ){
						_callback(_data);
					},
					error : function (_data ) {
						_callback(_data);
					}
				});
			}
		},		
		/*Personal page*/
		_personalPage : function (_data){
			_html = '<form id="personalForm" action="/sysmanage/personal/update" method="POST">';
			_html += '<ul>';
				_html += '<li>';
					_html += '<div class="xtulleft">用户名：</div>';
					_html += '<div class="xtulright" name="username" id="username">'+_data.username+'</div>';
					_html += '<div class="clear"></div>';
				_html += '</li>';
	            _html +='<li>';
	                _html +='<div class="xtulleft">登录密码：</div>';
	                _html +='<div class="xtulright"><input type="password" class="xtrpsw" name="password" id="password"/><span>*&nbsp;6-8位，不含特殊符号</span></div>';
	                _html +='<div class="clear"></div>';
	            _html +='</li>';
	            _html +='<li>';
	                _html +='<div class="xtulleft">确认密码：</div>';
	                _html +='<div class="xtulright"><input type="password" class="xtrpsw" name="repassword" id="repassword"/><span>*</span></div>';
	                _html +='<div class="clear"></div>';
	            _html +='</li>';
	            _html +='<li>';
	                _html +='<div class="xtulleft">性别：</div>';
	                if( _data.sex == 1){
	                	_html +='<div class="xtulright"><input type="radio" name="sex" value="1" checked="checked"/>男&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="sex" value="0"/>女</div>';
	                }else{
	                _html +='<div class="xtulright"><input type="radio" name="sex" value="1" />男&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="sex" value="0" checked="checked" />女</div>';
	                }
	                _html +='<div class="clear"></div>';
	            _html +='</li>';
	            _html +='<li>';
	                _html +='<div class="xtulleft">生日：</div>';
	                _html +='<div class="xtulright"><input type="text" class="xtrtex" name="birthday" id="birthday" value="'+_data.birthday+'"/></div>';
	                _html +='<div class="clear"></div>';
	            _html +='</li>';
	            _html +='<li>';
	                _html +='<div class="xtulleft">邮箱：</div>';
	                _html +='<div class="xtulright"><input type="text" class="xtrpsw" name="email" id="email" value="'+_data.email+'"/></div>';
	                _html +='<div class="clear"></div>';
	            _html +='</li>';
	            _html +='<li>';
	                _html +='<div class="xtulleft">电话：</div>';
	                _html +='<div class="xtulright"><input type="text" class="xtrpsw" name="phone" id="phone" value="'+_data.phone+'"/></div>';
	                _html +='<div class="clear"></div>';
	            _html +='</li>';
	            _html +='<li>';
	               _html +='<div class="xtulleft">照片：</div>';
	                   _html +='<div class="xtulright " id="personalUpload" >';
 	                   	
	                           _html +='<div class="zhaop"><img src="/circlestatic/images/zp.jpg" /></div>';
	                   _html +='</div>';
	                   _html +='<input type="hidden" name="avator" value="zp.jpg"/>';
	                   _html +='<div class="clear"></div>';
	            _html +='</li>';
	            _html +='<li>';
	                   _html +='<div class="xtulleft">单位：</div>';
	                   _html +='<div class="xtulright">';
	                       _html +='<select class="xtrsele" name="provinceid" id="provinceid"><option value="1">省市</option></select>';
	                       _html +='<select class="xtrsele" name="cityid" id="cityid"><option value="18">区县</option></select>';
	                       _html +='<input type="text" class="xtrpsw" name="county" id="county"/>';
	                   _html +='</div>';
	                   _html +='<div class="clear"></div>';
	            _html +='</li>';
	            _html +='<li>';
	                   _html +='<div class="xtulright">';
	                    _html +='<input type="submit" value="保存" class="OffOkbut" />';
	                   _html +='</div>';
	                   _html +='<div class="clear"></div>';
	            _html +='</li>';
	        _html +='</ul>';
	        _html +='</form>';
			
			return _html;
		},
		
		/*Invite page*/
		_invitePage : function ( _data ){
			_html = '<ul>';
				_html +='<li>';
                	_html +='<div class="yqul">';
                	_html +='<input type="text" id="inviteKey" name="inviteKey" class="xtrpsw" value="'+_data.data.key+'" />';
                	_html +='<input type="hidden" id="inviteKeyH" name="inviteKeyH" class="xtrpsw" value="'+_data.data.key+'" />';
                	_html +='<input type="button"  value="查询" class="XTOk inviteSearch"  />';
	            	
	            	
                	_html +='</div>';
                _html +='</li>';
                _html +='<li>';
                _html +='<div class="yqul">';
                _html +='<table>';
                    _html +='<tr class="yqtr">';
                        _html +='<td>圈子名称</td>';
                        _html +='<td>圈主</td>';
                        _html +='<td>邀请时间</td>';
                        _html +='<td>操作</td>';
                    _html +='</tr>';
                    if (_data.code) {
        				$.each(_data.data.items, function(i, n){
                    _html +='<tr>';
                        _html +='<td style="text-align:left;"><a href="#invite#'+ n.circlename +'" class="circleDetail" data-id="'+ n.circleid +'"  data-name="'+ n.circlename +'" >'+ n.circlename +'</a></td>';
                        _html +='<td>'+ n.username +'</td>';
                        _html +='<td>'+ n.formartTime +'</td>';
                        if( n.status == 0){
                        	_html +='<td><a href="#" data-id="'+ n.id +'" data-type="y" class="inviteManage" >同意</a>&nbsp;&nbsp;<a href="#" data-id="'+ n.id +'" data-type="n"  class="inviteManage" >拒绝</a></td>';
                        }else{
                        	_status = (n.status == 1) ? '已加入' : '已拒绝';
                        	_class = (n.status == 1) ? 'class="c_green"' : 'class="c_red"';
                        	_html +='<td><a href="" '+ _class +'/>'+ _status +'</a></td>';
                        }
                    _html +='</tr>';
        		});
                _html +='</table></div></li>';
				if (_data.data.total_pages > 1) {
					_html +='<li>';
                    _html +='<div class="xtulright">';
                    	_html +='<div class="xtRleft">总共有&nbsp;<span>' + _data.data.total_items + '</span>条</div>';
                        _html +='<div class="xtRrighg">';
                            _html +='<span><input type="button"  class="syspage" value="首页" class="inpubolr" data="/sysmanage/invite?page=1&pageSize='+ _data.data.pageSize +'" /></span>';
                            _html +='<span><input type="button"  class="syspage" value="上一页" class="inpubolr" data="/sysmanage/invite/?page='+ _data.data.before+ '&pageSize='+ _data.data.pageSize +'" /></span>';
                            _html += _data.data.lists;
                            _html +='<span><input type="button"  class="syspage" value="下一页" class="inpubolr" data="/sysmanage/invite/?page='+ _data.data.next+ '&pageSize='+ _data.data.pageSize +'" /></span>';
                            _html +='<span><input type="button"  class="syspage" value="尾页" class="inpubolr" data="/sysmanage/invite/?page='+ _data.data.last +'&pageSize='+ _data.data.pageSize +'"/></span>';
                        _html +='</div>';
                        _html +='<div class="clear"></div>';
                    _html +='</div>';
                    _html +='<div class="clear"></div>';
                _html +='</li>';
				}
			}else{
				_html +='<tr><td colspan="8">暂无数据</td></tr>';
			}
                    _html +='</ul>';
                    return _html;
		},
		
		/*Member page*/
		_memberPage : function ( _data ){
			var _html = '<ul>';
			_html +='<li>';
	            _html +='<div class="yhulleft">';
	            	_html +='<span><input type="button" value="新增用户" class="yhbut1 memberManage" data="add" /></span>';
	            	_html +='<span><input type="button" value="导入用户" class="yhbut2 memberManage" data="import" /></span>';
	            	_html +='<span><input type="button" value="导出用户" class="yhbut3 memberManage" data="export"/></span>';
	            _html +='</div>';
	            _html +='<div class="yhulright">';
	            	_html +='<input type="text" id="memberKey" name="memberKey" class="xtrpsw" value="'+_data.data.key+'" />';
	            	_html +='<input type="button"  value="查询" class="XTOk memberSearch" />';
	            	
	            	_html +='<input type="hidden" id="memberKeyH" name="memberKeyH" value="'+_data.data.key+'"/>';
	            _html +='</div>';
	            _html +='<div class="clear"></div>';
            _html +='</li>';
            _html +='<li>';
	            _html +='<div class="yqul">';
	            	_html +='<table>';
		            	_html +='<tr class="yqtr">';
		                    _html +='<td><input type="checkbox" class="check" id="chooseAll"/></td>';
		                    _html +='<td>用户名</td>';
		                    _html +='<td>真实姓名</td>';
		                    _html +='<td>单位</td>';
		                    _html +='<td>角色</td>';
		                    _html +='<td>状态</td>';
		                    _html +='<td>创建时间</td>';
		                    _html +='<td>操作</td>';
		                _html +='</tr>';
			if (_data.code) {
				$.each(_data.data.items, function(i, n){
					_html +='<tr>';
	                    _html +='<td><input type="checkbox" class="check" name="chkItem[]" value="'+ n.userid +'" /></td>';
	                    _html +='<td style="text-align:left"><a href="#">lium</a></td>';
	                    _html +='<td>' + n.username + '</td>';
	                    _html +='<td>' + n.name + '</td>';
	                    _html +='<td>' + n.role + '</td>';
	                    _html +='<td>' + (n.status == 0 ? "正常" : "禁用") + '</td>';
	                    _html +='<td>' + n.created + '</td>';
	                    _html +='<td>';
	                         _html +='<input type="button" value="编辑"  class="deletBut1" data-id="' + n.userid + '" />';
	                         _html +='<input type="button" value="删除"  class="deletBut1 Delopration" data-id="' + n.userid + '" />';
	                    _html +='</td>';
	                _html +='</tr>';
				});
				_html += '</table></div></li>';
				if (_data.data.total_pages > 1) {
					_html +='<li>';
                	_html +='<div class="xtulleft"><input type="button"  value="删除" class="XTOk" id="memberDelBtn"  /></div>';
                    _html +='<div class="xtulright">';
                    	_html +='<div class="xtRleft">总共有&nbsp;<span>' + _data.data.total_items + '</span>条</div>';
                        _html +='<div class="xtRcent">每条记录数&nbsp;<select class="xtrsele" id="selectPageSize">'+ _data.data.pageSizeOption +'</select></div>';
                        _html +='<div class="xtRrighg">';
                            _html +='<span><input type="button"  class="syspage" value="首页" class="inpubolr" data="/sysmanage/member?page=1&pageSize='+ _data.data.pageSize +'" /></span>';
                            _html +='<span><input type="button"  class="syspage" value="上一页" class="inpubolr" data="/sysmanage/member/?page='+ _data.data.before+ '&pageSize='+ _data.data.pageSize +'" /></span>';
                            _html += _data.data.lists;
                            _html +='<span><input type="button"  class="syspage" value="下一页" class="inpubolr" data="/sysmanage/member/?page='+ _data.data.next+ '&pageSize='+ _data.data.pageSize +'" /></span>';
                            _html +='<span><input type="button"  class="syspage" value="尾页" class="inpubolr" data="/sysmanage/member/?page='+ _data.data.last +'&pageSize='+ _data.data.pageSize +'"/></span>';
                        _html +='</div>';
                        _html +='<div class="clear"></div>';
                    _html +='</div>';
                    _html +='<div class="clear"></div>';
                _html +='</li>';
				}
			}else{
				_html +='<tr><td colspan="8">暂无数据</td></tr>';
			}
			_html += '</ul>';
            return _html;
                	
		},
		
		_companyPage : function ( _data ){
				
			console.log('company: '+_data);
			_html ='<ul>';
			_html +='<li>';
			_html +='<div class="yqul">';
			_html +='<span>单位名称:</span>';
			_html +='<input type="text" class="xtrpsw1" id="companyKey" name="companyKey" value="'+_data.data.key+'"/>';
			_html +='<span style="margin-left:20px;">区域:</span>';
			_html +='<select class="xtrsele" name="regionalOption" id="regionalOption">';
			_html += _data.data.regionalOption;
			_html +='</select>';
			_html +='<input type="button"  value="查询" class="XTOk companySearch"  />';
			_html +='<input type="hidden" id="companyKeyH" name="companyKeyH" value="'+_data.data.key+'"/>';
			_html +='<input type="hidden" id="regionalOptionH" name="regionalOptionH" value="'+_data.data.regional+'"/>';
			_html +='</div>';
			_html +='<div class="clear"></div>';
			_html +='</li>';
			_html +='<li>';
			_html +='<div class="yqul">';
			_html +='<table>';
			_html +='<tr class="yqtr">';
			_html +='<td><input type="checkbox" class="check" /></td>';
			_html +='<td>单位名称</td>';
			_html +='<td>所属区域</td>';
			_html +='<td>电话</td>';
			_html +='<td>创建时间</td>';
			_html +='<td>人员数量</td>';
			_html +='<td>操作</td>';
			_html +='</tr>';
            if (_data.code) {
            	$.each(_data.data.items, function(i, n){            
					_html +='<tr>';
					_html +='<td><input type="checkbox" class="check" /></td>';
					_html +='<td style="text-align:left"><a href="#">'+ n.companyname +'</a></td>';
					_html +='<td>'+ n.regionalname +'</td>';
					_html +='<td>'+ n.phone +'</td>';
					_html +='<td>'+ n.formartTime +'</td>';
					_html +='<td>'+ n.num +'</td>';
					_html +='<td>';
					_html +='<input type="button" value="编辑"  data-id="' + n.id + '" class="deletBut1"/>';
					_html +='<input type="button" value="删除"  data-id="' + n.id + '" class="deletBut1 Delopration"/>';
					_html +='</td>';
					_html +='</tr>';
	        	});
	            _html +='</table></div></li>';
				if (_data.data.total_pages > 1) {
					_html +='<li>';
					_html +='<div class="xtulleft"><input type="button"  value="删除" class="XTOk"  /></div>';
					_html +='<div class="xtulright">';
					_html +='<div class="xtRleft">总共有&nbsp;<span>' + _data.data.total_items + '</span>条</div>';
					_html +='<div class="xtRrighg">';
					_html +='<span><input type="button"  class="syspage" value="首页" class="inpubolr" data="/sysmanage/company?page=1&pageSize='+ _data.data.pageSize +'" /></span>';
					_html +='<span><input type="button"  class="syspage" value="上一页" class="inpubolr" data="/sysmanage/company/?page='+ _data.data.before+ '&pageSize='+ _data.data.pageSize +'" /></span>';
					_html += _data.data.lists;
					_html +='<span><input type="button"  class="syspage" value="下一页" class="inpubolr" data="/sysmanage/company/?page='+ _data.data.next+ '&pageSize='+ _data.data.pageSize +'" /></span>';
					_html +='<span><input type="button"  class="syspage" value="尾页" class="inpubolr" data="/sysmanage/company/?page='+ _data.data.last +'&pageSize='+ _data.data.pageSize +'"/></span>';
					_html +='</div>';
					_html +='<div class="clear"></div>';
					_html +='</div>';
					_html +='<div class="clear"></div>';
					_html +='</li>';
				}
            }else{
            	_html +='<tr><td colspan="7">暂无数据</td></tr>';
            }
            _html +='</ul>';
            return _html;

		},
		
		_customerPage : function (){
        	_html ='<ul>';
            	_html +='<li>';
                	_html +='<div class="yqul">';
                      _html +='<span style="margin-left:20px;">区域:</span>';
                      _html +='<select class="xtrsele"><option></option></select>';
                     _html +='<input type="button"  value="查询" class="XTOk" />';
                    _html +='</div>';
                    _html +='<div class="clear"></div>';
                _html +='</li>';
                _html +='<li>';
                	_html +='<div class="yqul">';
                        _html +='<table>';
                            _html +='<tr class="yqtr">';
                                _html +='<td>区域名称</td>';
                                _html +='<td>区域内单位数量</td>';
                                _html +='<td>区域内用户数量</td>';
                                _html +='<td>区域管理员</td>';
                                _html +='<td>操作</td>';
                            _html +='</tr>';
                            _html +='<tr>';
                                _html +='<td style="text-align:left"><a href="#">缺省单位</a></td>';
                                _html +='<td>6</td>';
                                _html +='<td>48</td>';
                                _html +='<td>12</td>';
                                _html +='<td>';
                                	 _html +='<input type="button" value="指定管理员"   class="deletBut1"  />';
                                	 _html +='<input type="button" value="修改"  class="deletBut1" />';
                                     _html +='<input type="button" value="删除"  class="deletBut1"/>';
                                _html +='</td>';
                            _html +='</tr>';
                            _html +='<tr>';
                                _html +='<td style="text-align:left"><a href="#">缺省单位</a></td>';
                                _html +='<td>6</td>';
                                _html +='<td>48</td>';
                                _html +='<td>12</td>';
                                _html +='<td>';
                                	 _html +='<input type="button" value="指定管理员"   class="deletBut1"  />';
                                	 _html +='<input type="button" value="修改"  class="deletBut1" />';
                                     _html +='<input type="button" value="删除"  class="deletBut1"/>';
                                _html +='</td>';
                            _html +='</tr>';
                           _html +='<tr>';
                                _html +='<td style="text-align:left"><a href="#">缺省单位</a></td>';
                                _html +='<td>6</td>';
                                _html +='<td>48</td>';
                                _html +='<td>12</td>';
                                _html +='<td>';
                                	 _html +='<input type="button" value="指定管理员" class="deletBut1"   />';
                                	 _html +='<input type="button" value="修改"  class="deletBut1" />';
                                     _html +='<input type="button" value="删除"  class="deletBut1"/>';
                                _html +='</td>';
                            _html +='</tr>';
                        _html +='</table>';
                    _html +='</div>';
                _html +='</li>';
                _html +='<li>';
                	_html +='<div class="xtulleft"><input type="button"  value="新建" class="XTOk" /></div>';	
                    _html +='<div class="xtulright">';
                        _html +='<div class="xtRcent"><div style=" width:280px; _width:250px; height:2px; "></div></div>';
                        _html +='<div class="xtRrighg">';
                            _html +='<span><input type="button"  value="首页" class="inpubolr"/></span>';
                            _html +='<span><input type="button"  value="上一页" class="inpubolr"/></span>';
                            _html +='<span><input type="button"  value="1"/></span>';
                            _html +='<span><input type="button"  value="2"/></span>';
                            _html +='<span><input type="button"  value="3"/></span>';
                            _html +='<span><input type="button"  value="4"/></span>';
                            _html +='<span><input type="button"  value="5"/></span>';
                            _html +='<span><input type="button"  value="下一页" class="inpubolr"/></span>';
                            _html +='<span><input type="button"  value="尾页" class="inpubolr"/></span>';
                        _html +='</div>';
                         _html +='<div class="clear"></div>';
                    _html +='</div>';
                    _html +='<div class="clear"></div>';
                _html +='</li>';
            _html +='</ul>';
            return _html;
		},
		
		_circlePage : function ( _data ){
			
			_html ='<ul>';
            	_html +='<li>';
                	//_html +='<div class="yhulleft">';
            		//_html +='<span style="margin-left:20px;">区域:</span>';
        			//_html +='<select class="xtrsele" name="regionalOption" id="regionalOption">';
        			//_html += _data.data.regionalOption;
        			//_html +='<option>fdsaf</option>';
        			//_html +='</select>';
                    //_html +='</div>';
                	_html +='<div class="yhulleft">';
                    _html +='<input type="text" class="xtrpsw" id="circleKey" name="circleKey" value="'+ _data.data.key +'" />';
                    _html +='<input type="button"  value="查询" class="XTOk circleSearch" />';
         			_html +='<input type="hidden" id="circleKeyH" name="circleKeyH" value="'+ _data.data.key +'" />';
                    _html +='</div>';
                    _html +='<div class="clear"></div>';
                _html +='</li>';
                _html +='<li>';
                	_html +='<div class="yqul">';
                        _html +='<table>';
                            _html +='<tr class="yqtr">';
                                _html +='<td>圈子名称</td>';
                                _html +='<td>圈主</td>';
                                _html +='<td>单位</td>';
                                _html +='<td>创建时间</td>';
                                _html +='<td>审批状态</td>';
                                _html +='<td>操作</td>';
                            _html +='</tr>';
                            if (_data.code) {
                            $.each(_data.data.items, function(i, n){
                            _html +='<tr>';
                            	_html +='<td style="text-align:left;"><a href="#circle#'+ n.circlename +'" class="circleDetail" data-id="'+ n.circleid +'"  data-name="'+ n.circlename +'" >'+ n.circlename +'</a></td>';
                                _html +='<td>'+ n.username +'</td>';
                                _html +='<td>'+ n.companyname +'</td>';
                                _html +='<td>'+ n.formatTime+'</td>';
                                var _status = n.status==0 ? '待审核' : (n.status==1 ? '通过' : '禁止');
                                _html +='<td>'+ _status +'</td>';
                                
                                _html +='<td>';
                                	 _html +='<input type="button" value="审核"  data-type="review" data-id="' + n.id + '" class="circleManage" />';
                                     _html +='<input type="button" value="删除"  data-type="del" data-id="' + n.id + '" class="circleManage"/>';
                                _html +='</td>';
                            _html +='</tr>';
                           });
                           
                            _html +='</table></div></li>';
                if (_data.data.total_pages > 1) {
					_html +='<li>';
					_html +='<div class="xtulleft"><input type="button"  value="删除" class="XTOk"  /></div>';
					_html +='<div class="xtulright">';
					_html +='<div class="xtRleft">总共有&nbsp;<span>' + _data.data.total_items + '</span>条</div>';
					_html +='<div class="xtRrighg">';
					_html +='<span><input type="button"  class="syspage" value="首页" class="inpubolr" data="/sysmanage/circle?page=1&pageSize='+ _data.data.pageSize +'" /></span>';
					_html +='<span><input type="button"  class="syspage" value="上一页" class="inpubolr" data="/sysmanage/circle/?page='+ _data.data.before+ '&pageSize='+ _data.data.pageSize +'" /></span>';
					_html += _data.data.lists;
					_html +='<span><input type="button"  class="syspage" value="下一页" class="inpubolr" data="/sysmanage/circle/?page='+ _data.data.next+ '&pageSize='+ _data.data.pageSize +'" /></span>';
					_html +='<span><input type="button"  class="syspage" value="尾页" class="inpubolr" data="/sysmanage/circle/?page='+ _data.data.last +'&pageSize='+ _data.data.pageSize +'"/></span>';
					_html +='</div>';
					_html +='<div class="clear"></div>';
					_html +='</div>';
					_html +='<div class="clear"></div>';
					_html +='</li>';
                }
            }else{
            	_html +='<tr><td colspan="6">暂无数据</td></tr>';
            }
            _html +='</ul>';
            return _html;
			
		},
		_settingPage : function (){
			return '<div>暂无内容 </div>' ;
		},
		
		_logPage : function (){
			
			_html ='<ul>';
            	_html +='<li><span style="margin-left:20px;">用户从应用列表进入各个应用模块时，系统均会以日志的方式记录下来。请定期执行清空操作，以免记录过多。</span></li>';
                _html +='<li>';
                	_html +='<div class="yqul">';
                        _html +='<table>';
                            _html +='<tr class="yqtr">';
                            	_html +='<td><input type="checkbox" class="check" /></td>';
                                _html +='<td>日志时间</td>';
                                _html +='<td>客户端IP地址</td>';
                                _html +='<td>用户名</td>';
                                _html +='<td>真实姓名</td>';
                                _html +='<td>访问的应用模块</td>';
                                _html +='<td>操作</td>';
                            _html +='</tr>';
                            _html +='<tr>';
                            	_html +='<td><input type="checkbox" class="check" /></td>';
                                _html +='<td>2014.10.12</td>';
                                _html +='<td>114.246.113.100</td>';
                                _html +='<td style="text-align:left"><a href="#">lium</a></td>';
                                _html +='<td>小名</td>';
                                _html +='<td>登录</td>';
                                _html +='<td><input type="button" value="删除"  class="deletBut1"/></td>';
                            _html +='</tr>';
                             _html +='<tr>';
                            	_html +='<td><input type="checkbox" class="check" /></td>';
                                _html +='<td>2014.10.12</td>';
                                _html +='<td>114.246.113.100</td>';
                                _html +='<td style="text-align:left"><a href="#">lium</a></td>';
                                _html +='<td>小芳</td>';
                                _html +='<td>网站首页</td>';
                                _html +='<td><input type="button" value="删除"  class="deletBut1"/></td>';
                            _html +='</tr>';
                            _html +='<tr>';
                            	_html +='<td><input type="checkbox" class="check" /></td>';
                                _html +='<td>2014.10.12</td>';
                                _html +='<td>114.246.113.100</td>';
                                _html +='<td style="text-align:left"><a href="#">lium</a></td>';
                                _html +='<td>小虫</td>';
                                _html +='<td>视频课例</td>';
                                _html +='<td><input type="button" value="删除"  class="deletBut1"/></td>';
                            _html +='</tr>';
                        _html +='</table>';
                    _html +='</div>';
                _html +='</li>';
                
            _html +='</ul>';
            return _html;
		}
}








