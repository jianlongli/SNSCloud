function check_all(t,check_name){
  var chs=document.getElementsByName(check_name);
  var checked=t.checked;
  for(var i=0;i<chs.length;i++){
    chs[i].checked=checked;
    if(chs[i].onclick){
    	chs[i].onclick();
    	};
  }
}
function sub_act(){
			var members_id = document.getElementsByName("member_id[]");
			
		var t=true;
		var query_str = "";
		var query ="";
		for(var i=0;i<members_id.length;i++){
			if(members_id[i].checked==true){
				t=false;
				query_str += members_id[i].value+",";
			
			}
		}
		if(t){
			alert("请选择接收人!");
			return;
		}
			query_str=query_str.substring(0,query_str.length-1);
		
			//alert(query_str);return;
			opener.setData(query_str);
}
