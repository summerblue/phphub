
(function($){
    var PHPHub = {

        init: function(){
            var self = this;
            $(document).pjax('a', 'body');
            $(document).on('pjax:start', function() {
                NProgress.start();
            });
            $(document).on('pjax:end', function() {
                NProgress.done();
                self.siteBootUp();
            });
            self.siteBootUp();
        },

        /*
        * Things to be execute when normal page load
        * and pjax page load.
        */
        siteBootUp: function(){
            var self = this;
            self.initExternalLink();
            self.initTimeAgo();
            self.initEmoji();
            self.initScrollToTop();
            self.initTextareaAutoResize();
            self.initHeightLight();
        },

        /**
         * Open External Links In New Window
         */
        initExternalLink: function(){
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
        },

        /**
         * Automatically transform any Date format to human
         * friendly format, all you need to do is add a
         * `.timeago` class.
         */
        initTimeAgo: function(){
            moment.lang('zh-cn');
            $('.timeago').each(function(){
                $(this).text( moment( $(this).text() ).fromNow());
            });
        },

        /**
         * Enable emoji everywhere.
         */
        initEmoji: function(){
            emojify.run();
        },

        /**
         * Autoresizing the textarea when you typing.
         */
        initTextareaAutoResize: function(){
            $('textarea').autosize();
        },

        /**
         * Scroll to top in one click.
         */
        initScrollToTop: function(){
            $.scrollUp.init();
        },

        /**
         * Code heightlight.
         */
        initHeightLight: function(){
            Prism.highlightAll();
        }


    }
    window.PHPHub = PHPHub;
})(jQuery);

$(document).ready(function()
{
    PHPHub.init();
});

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
