$(document).ready(function(){
    moment.lang('zh-cn');
	$('.timeago').each(function(){
		$(this).text( moment( $(this).text() ).fromNow());	  
	});

	marked($('.markdown-body').text(), function (err, content) {
	  $('.markdown-body').html(content);
	  emojify.run();

	  $('.loading').fadeOut();

	  $('.markdown-body').fadeIn();

	});
})