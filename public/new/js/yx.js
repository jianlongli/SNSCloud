function show_pop(){//��ʾ���� 
    document.getElementById("winpop").style.display="block"; 
    timer=setInterval("changeH(4)",2);//����changeH(4),ÿ0.002�������ƶ�һ�� 
} 
function hid_pop(){//���ش��� 
    timer=setInterval("changeH(-4)",2);//����changeH(-4),ÿ0.002�������ƶ�һ�� 
} 
//www.jb51.net �ű�֮�Ҳ���ͨ�� 
function changeH(addH) { 
    var MsgPop=document.getElementById("winpop"); 
    var popH=parseInt(MsgPop.style.height||MsgPop.currentStyle.height);//��parseInt������ĸ߶�ת��Ϊ����,�Է�������Ƚϣ�JS��<style>�е�heightҪ��"currentStyle.height"�� 
    if (popH<=100&&addH>0||popH>=4&&addH<0){//����߶�С�ڵ���100(str>0)��߶ȴ��ڵ���4(str<0) 
        MsgPop.style.height=(popH+addH).toString()+"px";//�߶����ӻ����4������ 
    } 
    else{//���� 
        clearInterval(timer);//ȡ������,��˼��������߶ȳ���100������,�Ͳ��������ˣ���߶ȵ���0�����ˣ��Ͳ��ټ����� 
        MsgPop.style.display=addH>0?"block":"none"//�����ƶ�ʱ������ʾ,�����ƶ�ʱ�������أ���Ϊ�����б߿�,���Ի��ǿ��Կ���1~2����û����ȥ,��ʱ��Ͱ�DIV���ص��� 
    } 
} 
window.onload=function(){//���� 
setTimeout("show_pop()",800);//0.8������show_pop() 
} 