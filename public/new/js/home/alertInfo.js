(function ($) {
    var divs = "alertcalss"; //alert的class值
    var info = document.getElementsByTagName("body")[0] != null ? document.getElementsByTagName("body")[0] : document.getElementsByTagName("html")[0]; //获取标签信息填充位置
    var infocss = document.getElementsByTagName("head")[0] != null ? document.getElementsByTagName("head")[0] : document.getElementsByTagName("html")[0]; //获取样式信息填充位置
    //topinfo:标题
    //cengerInfo:弹出内容
    //centerimg:显示图片
    //width:alert宽
    //height:alert高
    $.alertInfo = function (topInfo, cengerInfo, centerimg, width, height) {
        isalert();
        $("<div class='hi" + divs + "'></div>").appendTo(info);
        $("<div class='" + divs + "'><div class='divsalerttop' onMouseDown='$.alertdow(event);' onMouseUp='$.alertdup(event);'>" + topInfo + "<span><a href='#this' onclick='$.alertdel();'>退出</a></span></div><div class='divsalertcenter'><div class='divsalertcenter_left'><img src=" + centerimg + " alt='我是提示图片'/></div><div class='divsalertcenter_right'>" + cengerInfo + "</div></div></div>").appendTo(info);
        alertwidth = width;
        alertheight = height;
        alertcss();
    }
    //检测是否存在自定义alert,存在及关闭
    function isalert() {

        if ($("." + divs).html() != null) {
            $("." + divs).remove();
            $(".hi" + divs).remove();
            $("#alertcss").remove();
        }
    }
    var winhei; //幕布 判断是否有竖向滚动条
    var winwid; //幕布 判断是否有横向滚动条
    var alertwidth = 300; //alert宽
    var alertheight = 200; //alert高
    function winmx() {
        try {
            winhei = (document.documentElement.clientHeight < document.body.clientHeight ? document.body.clientHeight + 10 : document.documentElement.clientHeight); //判断是否有竖向滚动条
            winwid = document.documentElement.clientWidth < document.body.clientWidth ? document.body.clientWidth : document.documentElement.clientWidth; //判断是否有横向滚动条
        } catch (e) {
            winhei = document.documentElement.clientHeight;
            winwid = document.documentElement.clientWidth;
        }

    }
    //加载样式
    function alertcss() {
        winmx();
        var str = "";
        str += ".hi" + divs + "{opacity:0.3;filter:alpha(opacity=30);background-color:#ccc; position:absolute;top:0px;left:0px;z-index:200;width:" + winwid + "px;height:" + winhei + "px;}"; //幕布
        //str += "." + divs + "{ border:1px solid #ccc;width:" + alertwidth + "px;z-index:201;height:" + alertheight + "px;position:absolute;left:" + ((winwid - alertwidth) / 2) + "px;top:" + (document.documentElement.scrollTop + ((document.documentElement.clientHeight - alertheight) / 2)) + "px;background-color:#fff;}";
        str += "." + divs + "{font-size:13px; border:1px solid #ccc;width:" + alertwidth + "px;z-index:201;height:" + alertheight + "px;position:absolute;left:" + ((winwid - alertwidth) / 2) + "px;top:" + (((document.documentElement.clientHeight - alertheight) / 2)) + "px;background-color:#efffff;}";
        str += "." + divs + "{ position:fixed; cursor:pointer;_position:absolute;_bottom:auto;_top:expression(eval(document.documentElement.scrollTop+document.documentElement.clientHeight-this.offsetHeight-(parseInt(this.currentStyle.marginTop,10)||0)-(parseInt(this.currentStyle.marginBottom,10)||0)));}";

        str += ".divsalerttop{border-bottom:1px solid #ccc;width:" + alertwidth + "px;height:22px;padding-top:8px;cursor:move;}";
        str += ".divsalerttop span{position:absolute;right:10px;}";
        str += ".divsalertcenter{width:" + alertwidth + "px;height:" + (alertheight - 30) + "px;}";
        str += ".divsalertcenter_left {width:100px;height:" + (alertheight - 90) + "px;float:left;text-align:center;padding-top:50px;}";
        str += ".divsalertcenter_left img{width:60px;height:60px;border:1px solid ccc;}";
        str += ".divsalertcenter_right{width:" + (alertwidth - 100) + "px;height:" + (alertheight - 90) + "px;float:left;text-align:center;padding-top:50px;}";
        $("<style id='alertcss' type='text/css'>" + str + "</style>").appendTo(infocss);
    }
    //关闭alert
    $.alertdel = function (e) {
        isalert();
    }
    window.onresize = function () {
        winmx();
        $(".hi" + divs).css("width", winwid + "px");
        $(".hi" + divs).css("height", winhei + "px");
        $("." + divs).css("left", ((winwid - alertwidth) / 2) + "px");
        //$("." + divs).css("top", (document.documentElement.scrollTop + ((document.documentElement.clientHeight - alertheight) / 2)) + "px");
        $("." + divs).css("top", (((document.documentElement.clientHeight - alertheight) / 2)) + "px");
    }
    //url:网页地址
    //topinfo:标题
    //width：弹出框 宽
    //height: 弹出框 高
    $.alertUrl = function (url, topInfo, width, height) {
        isalert();
        url = (url == null || url == "") ? "http://www.baidu.com" : url;
        topInfo = topInfo == null ? "浏览器" : topInfo;
        $("<div class='hi" + divs + "'></div>").appendTo(info);
        $("<div class='" + divs + "'><div class='divsalerttop' onMouseDown='$.alertdow(event);' onMouseUp='$.alertdup(event);'>" + topInfo + "<span><a href='#this' onclick='$.alertdel();'>退出</a></span></div><div class='divsalertcenter'> <iframe frameborder='no' src='" + url + "'></iframe></div></div>").appendTo(info);
        alertwidth = width;
        alertheight = height;
        alerturlcss();
    }
    //加载样式
    function alerturlcss() {
        winmx();
        var str = "";
        str += ".hi" + divs + "{opacity:0.3;filter:alpha(opacity=30);background-color:#ccc; position:absolute;top:0px;left:0px;z-index:200;width:" + winwid + "px;height:" + winhei + "px;}"; //幕布
        //str += "." + divs + "{ border:1px solid #ccc;width:" + alertwidth + "px;z-index:201;height:" + alertheight + "px;position:absolute;left:" + ((winwid - alertwidth) / 2) + "px;top:" + (document.documentElement.scrollTop + ((document.documentElement.clientHeight - alertheight) / 2)) + "px;background-color:#fff;}";
        str += "." + divs + "{font-size:13px; border:1px solid #ccc;width:" + alertwidth + "px;z-index:201;height:" + alertheight + "px;position:absolute;left:" + ((winwid - alertwidth) / 2) + "px;top:" + (((document.documentElement.clientHeight - alertheight) / 2)) + "px;background-color:#efffff;}";
        str += "." + divs + "{ position:fixed; cursor:pointer;_position:absolute;_bottom:auto;_top:expression(eval(document.documentElement.scrollTop+document.documentElement.clientHeight-this.offsetHeight-(parseInt(this.currentStyle.marginTop,10)||0)-(parseInt(this.currentStyle.marginBottom,10)||0)));}";

        str += ".divsalerttop{border-bottom:1px solid #ccc;width:" + alertwidth + "px;height:22px;padding-top:8px;cursor:move;}";
        str += ".divsalerttop span{position:absolute;right:10px;}";
        str += ".divsalertcenter{width:" + alertwidth + "px;height:" + (alertheight - 30) + "px;}";
        str += ".divsalertcenter iframe{width:" + (alertwidth - 4) + "px;height:" + (alertheight - 30) + "px;}";
        $("<style id='alertcss' type='text/css'>" + str + "</style>").appendTo(infocss);
    }
    //加载鼠标拖动处理区
    //开始
    var juwidth = 0;
    var juheight = 0;
    var moushu = 0;
    $.alertdow = function (ev) {
        var mousePos = mouseCoords(ev);
        juwidth = Number(mousePos.x) - Number($("." + divs).css("left").replace("px", ""));
        juheight = Number(mousePos.y) - Number($("." + divs).css("top").replace("px", ""));

        moushu = 1;
    }
    $.alertdup = function () {
        moushu = 0;
    }



    function mouseMove(ev) {
        ev = ev || window.event;
        var mousePos = mouseCoords(ev);
        //alert(ev.pageX); 


        if (moushu == 1) {

            $("." + divs).css("left", mousePos.x - Number(juwidth) + "px");
            $("." + divs).css("top", mousePos.y - Number(juheight) + "px");
        }
    }

    function mouseCoords(ev) {
        if (ev.pageX || ev.pageY) {
            return { x: ev.pageX, y: ev.pageY };
        }
        return {
            x: ev.clientX + document.body.scrollLeft - document.body.clientLeft,
            y: ev.clientY + document.body.scrollTop - document.body.clientTop
        };
    }

    document.onmousemove = mouseMove;



    //结束
})(jQuery)