<?php namespace Phphub\Reply;

use Phphub\Forms\ReplyCreationForm;
use Phphub\Core\CreatorListener;
use Phphub\Core\Mention;
use Reply, Auth, Topic, Notification, Carbon;

class ReplyCreator
{
    protected $form;
    protected $parser;

    public function __construct(ReplyCreationForm $form, Mention $parser)
    {
        $this->form = $form;
        $this->parser = $parser;
    }

    public function create(CreatorListener $observer, $data)
    {
        $data['user_id'] = Auth::user()->id;
        $data['body'] = $this->parser->parse($data['body']);

        // Validation
        $this->form->validate($data);

        $reply = Reply::create($data);
        if ( ! $reply) 
        {
            return $observer->creatorFailed($reply->getErrors());
        }

        // 话题最后回复的用户还有更新时间戳
        $topic = Topic::find($data['topic_id']);
        $topic->last_reply_user_id = Auth::user()->id;
        $topic->reply_count++;
        $topic->updated_at = Carbon::now()->toDateTimeString();
        $topic->save();

        Auth::user()->increment('reply_count', 1);

        // 通知帖子作者
        Notification::batchNotify('new_reply', Auth::user(), [$topic->user], $topic, $reply);
        
        // 关注此贴的用户也提醒下
        Notification::batchNotify('attention', Auth::user(), $topic->attentedBy, $topic, $reply);
        
        // 如果有 "@" 某个用户的话, 一并通知
        Notification::batchNotify('at', Auth::user(), $this->parser->users, $topic, $reply);
        
        return $observer->creatorSucceed($reply);
    }
}