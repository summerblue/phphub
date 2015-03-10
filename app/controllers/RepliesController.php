<?php

use Phphub\Core\CreatorListener;

class RepliesController extends \BaseController implements CreatorListener
{
    public function __construct()
    {
        parent::__construct();
        $this->beforeFilter('auth');
    }

    public function store()
    {
        return App::make('Phphub\Creators\ReplyCreator')->create($this, Input::except('_token'));
    }

    public function vote($id)
    {
        $reply = Reply::find($id);
        App::make('Phphub\Vote\Voter')->replyUpVote($reply);
        return Redirect::route('topics.show', [$reply->topic_id, '#reply'.$reply->id]);
    }

    public function destroy($id)
    {
        $reply = Reply::findOrFail($id);
        $this->authorOrAdminPermissioinRequire($reply->user_id);
        $reply->delete();

        $reply->topic->decrement('reply_count', 1);

        Flash::success(lang('Operation succeeded.'));

        $reply->topic->generateLastReplyUserInfo();

        return Redirect::route('topics.show', $reply->topic_id);
    }

    /**
     * ----------------------------------------
     * CreatorListener Delegate
     * ----------------------------------------
     */

    public function creatorFailed($errors)
    {
        Flash::error(lang('Operation failed.'));
        return Redirect::back();
    }

    public function creatorSucceed($reply)
    {
        Flash::success(lang('Operation succeeded.'));
        return Redirect::route('topics.show', array(Input::get('topic_id'), '#reply'.$reply->id));
    }
}
