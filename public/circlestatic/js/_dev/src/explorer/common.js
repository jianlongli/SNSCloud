var _t;
jQuery.common = {
	_showMsg : function ( _Id, _msg) {
		if (_Id && _msg) {
			clearTimeout (_t);
			$('#' + _Id).css({
				'width' : '100%',
				'border-color' : 'rgb(230, 219, 85)',
				'background' : 'rgb(255, 251, 204)',
				'border-radius' : '10',
				'height' : '30px',
				'padding-top' : '10px'
			});
			$('#' + _Id).html('<center><font style="color: red;">' + _msg + '</font></center>').slideDown();
			_t = setTimeout(function(){
				if ($('#' + _Id).css('display') == 'block') {
					$('#' + _Id).slideUp();
				}
			}, 3000);
		}
		return false;
	},
		
	_swfUpload : function (_uploadSuccessCallback, _queueCompleteCallback) {
		var settings = {
				flash_url : "/circlestatic/js/swfupload.swf",
				upload_url: "/circle/newcircle/",	
				file_size_limit : "10 MB",
				file_types : "*.jpg;*.jpeg;*.png;",
				file_types_description : "All Files",
				file_upload_limit : 0,  //配置上传个数
				file_queue_limit : 0,
				custom_settings : {
					progressTarget : "fsUploadProgress",
					cancelButtonId : "btnCancel"
				},
				debug: false,

				// Button settings
				button_image_url: "/circlestatic/images/TestImageNoText_65x29.png",
				button_width: "100",
				button_height: "30",
				button_placeholder_id: "spanButtonPlaceHolder",
				button_text: '<span class="theFont"></span>',
				button_text_style: ".theFont { font-size: 16; }",
				button_text_left_padding: 12,
				button_text_top_padding: 3,
				
				file_queued_handler : fileQueued,
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_start_handler : uploadStart,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : _uploadSuccessCallback,
				upload_complete_handler : uploadComplete,
				queue_complete_handler : _queueCompleteCallback	
		};
		swfu = new SWFUpload(settings);
	},
	
	_ajax : function ( _formId, _callback ) {
		if (_formId && _callback) {
			$.ajax({
                url: $('#' + _formId).attr('action'),
                type: $('#' + _formId).attr('method'),
                data: $('#' + _formId).serialize(),
                success: function ( _data ) { 
					_callback(_data);
                }
            })
		}
	}
};
