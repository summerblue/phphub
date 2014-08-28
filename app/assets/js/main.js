
$(document).ready(function()
{
    moment.lang('zh-cn');
	$('.timeago').each(function(){
		$(this).text( moment( $(this).text() ).fromNow());
	});

    // Open External Links In New Window
    $('a[href^="http://"], a[href^="https://"]').each(function() {
       var a = new RegExp('/' + window.location.host + '/');
       if(!a.test(this.href) ) {
           $(this).click(function(event) {
               event.preventDefault();
               event.stopPropagation();
               window.open(this.href, '_blank');
           });
       }
    });

	emojify.run();

    $.scrollUp();
})
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
