<?php namespace Phphub\Reply;

use Phphub\Forms\ReplyCreationForm;
use Phphub\Core\CreatorListener;
use Reply, Auth;

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

        return $observer->creatorSucceed($reply);
    }
}