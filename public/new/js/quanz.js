function ShowMenu(obj,noid){
	var block =	document.getElementById(noid);
	var n = noid.substr(noid.length-1);
	if(noid.length==4){
		var ul = document.getElementById(noid.substring(0,3)).getElementsByTagName("ul");
		var h2 = document.getElementById(noid.substring(0,3)).getElementsByTagName("h2");
		for(var i=0; i<h2.length;i++){
			h2[i].innerHTML = h2[i].innerHTML.replace("","");
			h2[i].style.color = "";
		}
		obj.style.color = "#000";
		for(var i=0; i<ul.length; i++){if(i!=n){ul[i].className = "no";}}
	}else{
		var span = document.getElementById("menu").getElementsByTagName("span");
		var h1 = document.getElementById("menu").getElementsByTagName("h1");
		for(var i=0; i<h1.length;i++){
			h1[i].innerHTML = h1[i].innerHTML.replace("","");
			h1[i].style.color = "";
		}
		obj.style.color = "#cd1048";
		for(var i=0; i<span.length; i++){if(i!=n){span[i].className = "no";}}
	}
	if(block.className == "no"){
		block.className = "";
		obj.innerHTML = obj.innerHTML.replace("","");
	}else{
		block.className = "no";
		obj.style.color = "";
	}
}