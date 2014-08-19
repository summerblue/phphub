$(document).ready(function(){
	
    moment.lang('zh-cn');
	$('.timeago').each(function(){
		$(this).text( moment( $(this).text() ).fromNow());	  
	});

	marked.setOptions({
	  renderer: new marked.Renderer(),
	  gfm: true,
	  tables: true,
	  breaks: false,
	  pedantic: false,
	  sanitize: true,
	  smartLists: true,
	  smartypants: false
	});

	marked($('.markdown-body').text(), function (err, content) {
	  $('.markdown-body').html(content);
	  
	  $('.loading').fadeOut();
	  $('.markdown-body').fadeIn();
	});

	$('.markdown-reply').each(function(){
		var _this = $(this);
		marked(_this.text(), function (err, content) {
		  _this.html(content);
		});
	});

	setTimeout(function(){ 
		emojify.run();
	}, 500); 
})