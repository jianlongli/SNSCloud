$.circlemanage ={
		
		/*默认加载方法*/
		_init : function (_action,_param){
			var _allowAction = ['circleinfo','member','experts','info'];
			if ($.inArray(_action , _allowAction) === -1)
				_action = 'circleinfo';
			this._getData ('circlemanage/'+_action , _action,_param);
		},
		
		/*Get content*/
		_getData : function (_url , _key ,_param){
			$.ajax({
				url : _url,
				data : _param,
				beforeSend: function(){},
				success : function (_data){
					$(".manageContent").html(_data);
				},
				error : function (){
					alert('error');
				}
			});
		},
		
		/*Set data*/
		_setData : function ( _url , _param , _callback ){
			if (_url && _param && _callback) {
				$.ajax({
					url : _url,
					data : _param,
					type : "POST",
					beforeSend: function(){},
					success : function (_data){
						_callback(_data);
					},
					error : function (_data ) {
						_callback(_data);
					}
				});
			}
		},
}