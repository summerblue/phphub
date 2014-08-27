<?php

class AttentionsController extends \BaseController
{
	public function createOrDelete($id)
	{
		$topic = Topic::find($id);

		if (Attention::isUserAttentedTopic(Auth::user(), $topic))
		{
			$message = trans('template.Successfully remove attention.');
			Auth::user()->attentTopics()->detach($topic->id);
		}
		else
		{
			$message = trans('template.Successfully_attention');
			Auth::user()->attentTopics()->attach($topic->id);
		}
		Flash::success($message);
		return Redirect::back();
	}
}
