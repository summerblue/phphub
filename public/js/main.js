$(document).ready(function(){
    moment.lang('zh-cn');
	$('.timeago').each(function(){
		$(this).text( moment( $(this).text() ).fromNow());	
	});
})