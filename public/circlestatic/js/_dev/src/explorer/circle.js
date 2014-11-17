var _t;
jQuery.circle = {
	
	_create : function () {
		art.dialog.open ('/circle/newcircle/', {
			id : 'circle_div',
			fixed : true,
			title : '申请圈子',
			lock : true,
			height : '650px',
			width : 'auto',
			ok:function() {
				var _name = this.iframe.contentWindow.$("input[name='qz_name']").val();
				var _desc = this.iframe.contentWindow.$("textarea[name='qz_desc']").val();
				var _logo = this.iframe.contentWindow.$("input[name='qz_logo']").val();
				var _circle_admin = this.iframe.contentWindow.$("input[name='qz_admin']").val();
				var _circle_member = this.iframe.contentWindow.$("input[name='qz_member']").val();
				var _comment_flag = this.iframe.contentWindow.$("input[name='comment_flag']").val();
				var _topic_flag = this.iframe.contentWindow.$("input[name='topic_flag']").val();
				var _error_msg = '';
				if (_name == '') {
					_error_msg = '圈子名称不得为空';
				} else if (_desc == '') {
					_error_msg = '圈子描述不得为空';
				} else if (_logo == '') {
					_error_msg = '请上传圈子LOGO';
				} else if (_circle_admin == '') {
					_error_msg = '请添加圈子管理员';
				} else if (_circle_member == '') {
					_error_msg = '请添加圈子成员';
				}
				if (_error_msg) {
	        		this.iframe.contentWindow.$.common._showMsg ('error_div', _error_msg);
	        	} else {
	        		this.iframe.contentWindow.$.common._ajax('apply_form', this.iframe.contentWindow.afterSubmit);
	        	}
				return false;
			},
			cancel: true
		});
	},
	
	_get_all_circle : function ( _pageId, _callback, _search ){
		_pageId = _pageId ? parseInt (_pageId ) : 1;
		_search = _search ? _search : '';
		$.ajax({
			url : 'circle/getlist?page=' + _pageId + '&search=' + _search,
			dataType:'json',
			success:function(data){
				if (typeof( _callback ) == 'function'){
					_callback (data);
				}
			}
		});		
	}
};