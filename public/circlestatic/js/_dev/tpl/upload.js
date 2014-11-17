define(function(require, exports) {
    return{
        html:"<div class='file_upload'>\
            <div class='top_nav'>\
               <a href='javascript:void(0);' class='menu this tab_upload'>{{LNG.upload_local}}</a>\
               <div style='clear:both'></div>\
            </div>\
            <div class='upload_path'>{{LNG.save_path}}:<b></b></div>\
            <div class='upload_box'>\
                <div class='btns'><div id='picker'>{{LNG.upload_select}}</div>\
                <div tips class='tips' title='{{LNG.upload_size_info}}'>{{LNG.upload_max_size}}:1G</div>\
                <div style='clear:both'></div></div>\
                <div id='uploader' class='wu-example'>\
                    <div id='thelist' class='uploader-list'></div>\
                </div>\
            </div>\
        </div>"
    }
});
