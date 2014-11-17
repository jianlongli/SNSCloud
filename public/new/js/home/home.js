$(window).ready(function(e){
 var winhei; //幕布 判断是否有竖向滚动条
    var winwid; //幕布 判断是否有横向滚动条

	    try {
            winhei = (document.documentElement.clientHeight < document.body.clientHeight ? document.body.clientHeight + 10 : document.documentElement.clientHeight); //判断是否有竖向滚动条
            winwid = document.documentElement.clientWidth < document.body.clientWidth ? document.body.clientWidth : document.documentElement.clientWidth; //判断是否有横向滚动条
        } catch (e) {
            winhei = document.documentElement.clientHeight;
            winwid = document.documentElement.clientWidth;
        }

        $("#ShowDIV").css("left",((winwid-1200)/2)+"px");
        $("#ShowDIV").css("top",((winhei -650)/2)+"px");
});