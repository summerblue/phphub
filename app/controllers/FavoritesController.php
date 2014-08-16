<?php

class FavoritesController extends \BaseController 
{	
	public function createOrDelete($id)
	{
		$topic = Topic::find($id);

		if (Favorite::isUserFavoritedTopic(Auth::user(), $topic)) 
		{
			$message = '成功取消收藏';
			Auth::user()->favoriteTopics()->detach($topic->id);
		}
		else
		{
			$message = '成功收藏话题';
			Auth::user()->favoriteTopics()->attach($topic->id);
		}
		Flash::success($message);
		return Redirect::back();
	}


}
