<?php namespace Phphub\Reply;

use Phphub\Forms\ReplyCreationForm;
use Phphub\Core\CreatorListener;
use Reply, Auth, Topic, Notification, Carbon;

class ReplyCreator
{
    protected $replyModel;
    protected $form;

    public function __construct(Reply $replyModel, ReplyCreationForm $form)
    {
        $this->userModel  = $replyModel;
        $this->form = $form;
    }

    public function create(CreatorListener $observer, $data)
    {
        $data['user_id'] = Auth::user()->id;

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

        // 通知帖子作者
        Notification::notify('new_reply', Auth::user(), $topic->user, $topic, $reply);
        
        // 关注此贴的用户也提醒下
        
        
        // 如果有 "@" 某个用户的话, 一并通知
        

        Auth::user()->reply_count++;
        Auth::user()->save();
        
        return $observer->creatorSucceed($reply);
    }
}