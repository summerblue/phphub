
$(document).ready(function()
{
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
function textAreaAdjust(o) {
    if (o.scrollHeight > 105) 
    	o.style.height = "1px";
    	o.style.height = (25+o.scrollHeight)+"px";	
   } 
}
function preview(){
	replyContent = $("#reply_content");
	oldContent = replyContent.val();
	replyContent.fadeOut();

	if (oldContent) {
		marked(oldContent, function (err, content) {
		  $('.preview').html(content);
		});
	}
	
	$('.preview').fadeIn();
	$('#edit-btn').toggleClass('active');
	$('#preview-btn').toggleClass('active');
}

function showEditor(){
	$('.preview').fadeOut();
	$('#reply_content').fadeIn();

	$('#edit-btn').toggleClass('active');
	$('#preview-btn').toggleClass('active');
}

// reply a reply
function replyOne(username){
    replyContent = $("#reply_content");
	oldContent = replyContent.val();
	prefix = "@" + username + " ";
	newContent = ''
	if(oldContent.length > 0){
	    if (oldContent != prefix) {
	        newContent = oldContent + "\n" + prefix;
	    }
	} else {
	    newContent = prefix
	}
	replyContent.focus();
	replyContent.val(newContent);
	moveEnd($("#reply_content"));
}

var moveEnd = function(obj){
	obj.focus();

	var len = obj.value === undefined ? 0 : obj.value.length;

	if (document.selection) {
		var sel = obj.createTextRange();
		sel.moveStart('character',len);
		sel.collapse();
		sel.select();
	} else if (typeof obj.selectionStart == 'number' && typeof obj.selectionEnd == 'number') {
		obj.selectionStart = obj.selectionEnd = len;
	}
}
