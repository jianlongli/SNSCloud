function show_pop(){//显示窗口 
    document.getElementById("winpop").style.display="block"; 
    timer=setInterval("changeH(4)",2);//调用changeH(4),每0.002秒向上移动一次 
} 
function hid_pop(){//隐藏窗口 
    timer=setInterval("changeH(-4)",2);//调用changeH(-4),每0.002秒向下移动一次 
} 
//www.jb51.net 脚本之家测试通过 
function changeH(addH) { 
    var MsgPop=document.getElementById("winpop"); 
    var popH=parseInt(MsgPop.style.height||MsgPop.currentStyle.height);//用parseInt将对象的高度转化为数字,以方便下面比较（JS读<style>中的height要用"currentStyle.height"） 
    if (popH<=100&&addH>0||popH>=4&&addH<0){//如果高度小于等于100(str>0)或高度大于等于4(str<0) 
        MsgPop.style.height=(popH+addH).toString()+"px";//高度增加或减少4个象素 
    } 
    else{//否则 
        clearInterval(timer);//取消调用,意思就是如果高度超过100象素了,就不再增长了，或高度等于0象素了，就不再减少了 
        MsgPop.style.display=addH>0?"block":"none"//向上移动时窗口显示,向下移动时窗口隐藏（因为窗口有边框,所以还是可以看见1~2象素没缩进去,这时候就把DIV隐藏掉） 
    } 
} 
window.onload=function(){//加载 
setTimeout("show_pop()",800);//0.8秒后调用show_pop() 
} 