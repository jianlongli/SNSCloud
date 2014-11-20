$(document).ready(function() {
	$("#zuoye").click(
		function(){
			var dialog = art.dialog.open(
			'/work/assign/?circleid=' + $(this).data('id'),
			{	
				id:'assign',
				title: '布置作业', 
				width: 860, 
				height: 600,
			})	
		}
	);

	$("#submit_assign").click(
		function(){
			var title=$("#title").val();
			var description=$("#description").val();
			var created=$("#created").val();
			var endtime=$("#endtime").val();
			var circleid=$("#circleid").val();
			var workid=$("#workid").val();
			var receivetype=$("input[name='receivetype']:checked").val();
			if(receivetype=='Y'){
				var receiveid="all";
			}else{
				var receiveid=$("#receiveid").val();
			}
			if(title=="") {
				$.common._showMsg('tishi','请填写作业标题')
				return false;
			}
			if(description=="") {
				$.common._showMsg('tishi','请填写作业介绍');
				return false;
			}
			if(receiveid=="") {
				$.common._showMsg('tishi','接收人不能为空');
				return false;
			}
			if(created=="") {
				$.common._showMsg('tishi','请填写发布日期');
				return false;
			}
			if(endtime=="") {
				$.common._showMsg('tishi','请填写失效日期');
				return false;
			}
			var timeb=checkEndTime(created,endtime)
			if(!timeb){
				$.common._showMsg('tishi','失效日期不能早于开始日期 ');
				return false;
			}
			
			$.ajax({
				url:'assign/?type=submit&title='+title+'&description='+description+"&created="+created+"&endtime="+endtime+"&receiveid="+receiveid+"&circleid="+circleid+"&workid="+workid,
				dataType:'json',
				// beforeSend:function(){
					// $('.tools-left .msg').stop(true,true).fadeIn(100);
				// },
				success:function(data){
					//alert(data.data);
					worklist('1');
					$("#title").val("");
					$("#description").val("");
					$("#created").val("");
					$("#endtime").val("");
					$("#receiveid").val("");
					//$("#circleid").val("");
					$("#workid").val("");
				},
			});	
		}
	);

	$("#myzuoye").click(
		function(){
			var dialog = art.dialog.open(
			'work/mywork',
			{	
				id:'assign',
				title: '布置作业', 
				width: 880, 
				height: 600,
			})
				
			
		}
	);
	
	$("#receiv").click(
		function(){
			var dialog = art.dialog.open(
			'work/mywork',
			{	
				id:'receiv',
				title: '', 
				width: 880, 
				height: 600,

			
			})
				
			
		}
	);

});


function worklist(page) {
		var circleid=$("#circleid").val();
		$.ajax({
				url:'assign/?type=ajax_list&circleid='+circleid+"&page="+page,
				dataType:'json',
				success:function(data){
					//alert(data.data)
					$("#alternatecolor").html(data.data);
					
				},
			});

}
function checkEndTime(startTime,endTime){  
    var start=new Date(startTime.replace("-", "/").replace("-", "/"));  
    var end=new Date(endTime.replace("-", "/").replace("-", "/"));  
    if(end<start){  
        return false;  
    }  
    return true;  
}  
	
	
