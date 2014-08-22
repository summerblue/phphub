<?php

use Phphub\Core\CreatorListener;

class RepliesController extends \BaseController implements CreatorListener
{
	public function __construct(Topic $topic)
    {
        $this->beforeFilter('auth', ['only' =>'store']);
    }

	public function store()
	{
		return App::make('Phphub\Reply\ReplyCreator')->create($this, Input::except('_token'));
	}

    public function vote($id)
    {
        $reply = Reply::find($id);
        App::make('Phphub\Vote\Voter')->replyUpVote($reply);
        return Redirect::back();
    }

    public function delete($id)
    {
        $reply = Reply::find($id);
        $this->authorOrAdminPermissioinRequire($reply->user_id);
        $reply->delete();

        $reply->topic->decrement('reply_count', 1);

        Flash::success("成功放入垃圾箱.");

        return Redirect::route('topics.show', $reply->topic_id);
    }

    /**
     * ----------------------------------------
     * CreatorListener Delegate
     * ----------------------------------------
     */

    public function creatorFailed($errors)
    {
    	Flash::error('评论发布失败.');
        return Redirect::back();
    }

    public function creatorSucceed($reply)
    {
        Flash::success('评论发布成功.');
        return Redirect::route('topics.show', array(Input::get('topic_id')));
    }
	
}
