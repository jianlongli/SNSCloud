//设定栏目的鼠标事件
function doClick_risingmenu(o){
	 o.className="navmenu_on"; 
	 var j; 
	 var id; 
	 var e; 
	 for(var i=1;i<=15;i++){ 
	   id ="risingmenu"+i;  
	   j = document.getElementById(id); 
	   e = document.getElementById("sub_con"+i);  
	    if(id != o.id){   	 
			j.className="navmenu_off";   	
			e.style.display = "none";   
			}
	    else{  
		   e.style.display = "block";	
	       }
	   }
	 }
	 //设定栏目的默认选项
function doView_risingmenu(o,intI,intJ){
	 o.className="navmenu_on";
	  var j; 
	  var id; 
	  var e;
	  var f; 
	  for(var i=1;i<=15;i++){  
	    id ="risingmenu"+i;   
	    j = document.getElementById(id);  
		e = document.getElementById("sub_con"+i);   
	      if(id != "risingmenu"+intI){   //设置一级的样式
	   	    j.className="navmenu_off";	 //设置二级的不显示
	   	    e.style.display = "none"; 
	        }
		else{   
	       j.className="navmenu_on";	
		   e.style.display = "block";	
		   if(intJ!=0){	f = document.getElementById("sub_con"+i+"_"+intJ);	
		    //设置二级的样式
		  f.className="submenu_on";	
		}
	   }
	 }
 }