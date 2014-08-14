<?php namespace Phphub\Reply;

use Phphub\Forms\ReplyCreationForm;
use Phphub\Core\CreatorListener;
use Reply, Auth, Topic;

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

        // 话题最后回复
        $topic = Topic::find($data['topic_id']);
        $topic->last_reply_user_id = Auth::user()->id;
        $topic->reply_count++;
        $topic->save();

        Auth::user()->reply_count++;
        Auth::user()->save();
        
        return $observer->creatorSucceed($reply);
    }
}