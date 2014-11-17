$.system ={
		
		/*默认加载方法*/
		_init : function (_action,_param){
			var _allowAction = ['personal','invite','member','company','customer','circle','setting','log'];
			if ($.inArray(_action , _allowAction) === -1)
				_action = 'personal';
			this._getData ('system/'+_action , _action,_param);
		},
		
		/*Get content*/
		_getData : function (_url , _key ,_param){
			$.ajax({
				url : _url,
				data : _param,
				beforeSend: function(){},
				success : function (_data){
					$(".XTglInfodiv").html(_data);
				},
				error : function (){
					alert('error');
				}
			});
		},
}