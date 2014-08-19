<?php

class AttentionsController extends \BaseController 
{
	public function createOrDelete($id)
	{
		$topic = Topic::find($id);

		if (Attention::isUserAttentedTopic(Auth::user(), $topic)) 
		{
			$message = '成功取消关注';
			Auth::user()->attentTopics()->detach($topic->id);
		}
		else
		{
			$message = '成功关注话题, 系统会通知你关于此话题最新的讨论.';
			Auth::user()->attentTopics()->attach($topic->id);
		}
		Flash::success($message);
		return Redirect::back();
	}
}
