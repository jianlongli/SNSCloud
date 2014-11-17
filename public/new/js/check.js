var nextState=1;
function change(obj){
var liArray=document.getElementsByTagName("LI");
var i=1;
var length=liArray.length;
switch(nextState){
case 1:
obj.innerHTML="当前选择";
for(;i<length;i++){
liArray[i].className="liShow";
}
nextState=0;
break;
case 0:
obj.innerHTML="当前选择";
for(;i<length;i++){
liArray[i].className="liHide";
}
nextState=1;
}
}