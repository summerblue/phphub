<?php

class AttentionsController extends \BaseController
{
    public function createOrDelete($id)
    {
        $topic = Topic::find($id);

        if (Attention::isUserAttentedTopic(Auth::user(), $topic))
        {
            $message = lang('Successfully remove attention.');
            Auth::user()->attentTopics()->detach($topic->id);
        }
        else
        {
            $message = lang('Successfully_attention');
            Auth::user()->attentTopics()->attach($topic->id);
            Notification::notify('topic_attent', Auth::user(), $topic->user, $topic);
        }
        Flash::success($message);
        return Redirect::route('topics.show', $topic->id);
    }
}
