$(function(){
	//菜单隐藏展开
	var tabs_i=0
	$('.vtitlef').click(function(){
		var _self = $(this);
		var j = $('.vtitlef').index(_self);
		if( tabs_i == j ) return false; tabs_i = j;
		$('.vtitlef em').each(function(e){
			if(e==tabs_i){
				$('em',_self).removeClass('v01f').addClass('v02f');
			}else{
				$(this).removeClass('v02f').addClass('v01f');
			}
		});
		$('.vocnf').slideUp().eq(tabs_i).slideDown();
	});
})