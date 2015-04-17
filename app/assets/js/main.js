
(function($){

    var original_title = document.title;
    var nCount = 0;

    var PHPHub = {
        init: function(){
            var self = this;
            $(document).pjax('a:not(a[target="_blank"])', 'body');
            $(document).on('pjax:start', function() {
                NProgress.start();
            });
            $(document).on('pjax:end', function() {
                NProgress.done();
                self.siteBootUp();
            });
            $(document).on('pjax:complete', function() {
                original_title = document.title;
                NProgress.done();
                self._resetTitle();
            });

            self.siteBootUp();
            self.initLightBox();
            self.initNotificationsCount();
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
            self.initAutocompleteAtUser();
            self.initScrollToTop();
            self.initTextareaAutoResize();
            self.initHeightLight();
            self.initLocalStorage();
            self.initEditorPreview();
            self.initReplyOnPressKey();
            self.initDeleteForm();
            self.initInlineAttach();
            self.snowing();
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
                var time_str = $(this).text();
                if(moment(time_str, "YYYY-MM-DD HH:mm:ss", true).isValid()) {
                    $(this).text(moment(time_str).fromNow());
                }
            });
        },

        /**
         * Enable emoji everywhere.
         */
        initEmoji: function(){
            emojify.setConfig({
                img_dir : Config.cdnDomain + 'assets/images/emoji',
                ignored_tags : {
                    'SCRIPT'  : 1,
                    'TEXTAREA': 1,
                    'A'       : 1,
                    'PRE'     : 1,
                    'CODE'    : 1
                }
            });
            emojify.run();

            $('#reply_content').textcomplete([
                { // emoji strategy
                    match: /\B:([\-+\w]*)$/,
                    search: function (term, callback) {
                        callback($.map(emojies, function (emoji) {
                            return emoji.indexOf(term) === 0 ? emoji : null;
                        }));
                    },
                    template: function (value) {
                        return '<img src="' + Config.cdnDomain + 'assets/images/emoji/' + value + '.png"></img>' + value;
                    },
                    replace: function (value) {
                        return ':' + value + ': ';
                    },
                    index: 1,
                    maxCount: 5
                }
            ]);
        },

        /**
         * Autocomplete @user
         */
        initAutocompleteAtUser: function() {
            var at_users = [],
                  user;
            $users = $('.media-heading').find('a.author');
            for (var i = 0; i < $users.length; i++) {
                user = $users.eq(i).text().trim();
                if ($.inArray(user, at_users) == -1) {
                    at_users.push(user);
                };
            };

            $('textarea').textcomplete([{
                mentions: at_users,
                match: /\B@(\w*)$/,
                search: function(term, callback) {
                    callback($.map(this.mentions, function(mention) {
                        return mention.indexOf(term) === 0 ? mention : null;
                    }));
                },
                index: 1,
                replace: function(mention) {
                    return '@' + mention + ' ';
                }
            }], {
                appendTo: 'body'
            });

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
        },

        /**
         * lightbox
         */
        initLightBox: function(){
            $(document).delegate('.content-body img:not(.emoji)', 'click', function(event) {
                event.preventDefault();
                return $(this).ekkoLightbox({
                    onShown: function() {
                        if (window.console) {
                            // return console.log('Checking our the events huh?');
                        }
                    }
                });
            });
        },

        /**
         * do content preview
         */
        runPreview: function() {
            var replyContent = $("#reply_content");
            var oldContent = replyContent.val();

            if (oldContent) {
                marked(oldContent, function (err, content) {
                  $('#preview-box').html(content);
                  emojify.run(document.getElementById('preview-box'));
                });
            }
        },

        /**
         * Init post content preview
         */
        initEditorPreview: function() {
            var self = this;
            $("#reply_content").focus(function(event) {
                $("#reply_notice").fadeIn(1500);
                $("#preview-box").fadeIn(1500);
                $("#preview-lable").fadeIn(1500);

                if (!$("#reply_content").val()) {
                    $("html, body").animate({ scrollTop: $(document).height()}, 1800);
                }
            });
            $('#reply_content').keyup(function(){
                self.runPreview();
            });
        },

        /**
         * Notify user unread notifications when they stay on the
         * page for too long.
         */
        initNotificationsCount: function(argumen) {
            var self = this;
            if (Config.user_id > 0) {
                function scheduleGetNotification(){
                    $.get( Config.routes.notificationsCount, function( data ) {

                        nCount = parseInt(data);
                        self._resetTitle();
                        setTimeout(scheduleGetNotification, 15000);
                    });
                };
                setTimeout(scheduleGetNotification, 15000);
            }
        },

        _resetTitle: function() {
            if (nCount > 0) {
                $('#notification-count').text(nCount);
                $('#notification-count').hasClass('badge-important') || $('#notification-count').addClass('badge-important');
                document.title = '(' + nCount + ') '+ original_title;
            } else {
                document.title =  original_title;
                $('#notification-count').text(0);
                $('#notification-count').addClass('badge-fade');
                $('#notification-count').removeClass('badge-important');
            }
        },

        /*
         * Use Ctrl + Enter for reply
         */
        initReplyOnPressKey: function() {
            $(document).on("keydown", "#reply_content", function(e)
            {
                if ((e.keyCode == 10 || e.keyCode == 13) && e.ctrlKey) {
                    $(this).parents("form").submit();
                    return false;
                }
            });
        },

        /*
         * Construct a form when using the following code, makes more clean code.
         *   {{ link_to_route('tasks.destroy', 'D', $task->id, ['data-method'=>'delete']) }}
         * See this answer: http://stackoverflow.com/a/23082278/689832
         */
        initDeleteForm: function() {
            $('[data-method]').append(function(){
                return "\n"+
                "<form action='"+$(this).attr('data-url')+"' method='POST' style='display:none'>\n"+
                "   <input type='hidden' name='_method' value='"+$(this).attr('data-method')+"'>\n"+
                "   <input type='hidden' name='_token' value='"+Config.token+"'>\n"+
                "</form>\n"
                })
                .attr('style','cursor:pointer;')
                .click(function() {
                    if ($(this).attr('data-method') == 'post') {
                        $(this).find("form").submit();
                    }
                    if ($(this).attr('data-method') == 'delete' && confirm("Are you sure want to proceed?")) {
                        $(this).find("form").submit();
                    }
                });
           // attr('onclick',' if (confirm("Are you sure want to proceed?")) { $(this).find("form").submit(); };');
        },

        /**
         * Local Storage
         */
        initLocalStorage: function() {
            var self = this;
            $("#reply_content").focus(function(event) {

                // Topic Title ON Topic Creation View
                localforage.getItem('topic-title', function(err, value) {
                    if ($('.topic_create #topic-title').val() == '' && !err) {
                        $('.topic_create #topic-title').val(value);
                    };
                });
                $('.topic_create #topic-title').keyup(function(){
                    localforage.setItem('topic-title', $(this).val());
                });

                // Topic Content ON Topic Creation View
                localforage.getItem('topic_create_content', function(err, value) {
                    if ($('.topic_create #reply_content').val() == '' && !err) {
                        $('.topic_create #reply_content').val(value);
                        self.runPreview();
                    }
                });
                $('.topic_create #reply_content').keyup(function(){
                    localforage.setItem('topic_create_content', $(this).val());
                });

                // Reply Content ON Topic Detail View
                localforage.getItem('reply_content', function(err, value) {
                    if ($('.topics-show #reply_content').val() == '' && !err) {
                        $('.topics-show #reply_content').val(value);
                        self.runPreview();
                    }
                });
                $('.topics-show #reply_content').keyup(function(){
                    localforage.setItem('reply_content', $(this).val());
                });
            })

            // Clear Local Storage on submit
            $("#topic-create-form").submit(function(event){
                localforage.removeItem('topic_create_content');
                localforage.removeItem('topic-title');
            });
            $("#reply-form").submit(function(event){
                localforage.removeItem('reply_content');
            });
        },

        /**
         * Upload image
         */
        initInlineAttach: function() {
            var self = this;
            $('#reply_content').inlineattach({
                uploadUrl: Config.routes.upload_image,
                extraParams: {
                  '_token': Config.token,
                },
                onUploadedFile: function(response) {
                    setTimeout(self.runPreview, 200);
                },
            });
        },

        /**
         * Snowing around the world
         */
        snowing: function() {

            // only show snow in Christmas
            var today = new Date()
            var christmas = new Date(today.getFullYear(), 11, 25) // Month is 0-11 in JavaScript
            if (today.getMonth() == 11 && (today.getDate() > 22 && today.getDate() < 30))
            {
                $('#body').snowfall({
                    flakeCount: 100,
                    minSize: 2,
                    maxSize:5,
                    round: true
                });
            }
        },

    }
    window.PHPHub = PHPHub;
})(jQuery);

$(document).ready(function()
{
    PHPHub.init();
});

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
