<?php

class Reply extends \Eloquent {

	protected $fillable = [
		'body', 
		'user_id', 
		'topic_id'
	];

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function topic()
	{
		return $this->belongsTo('Topic');
	}

	public static function userRecentReplies($user_id, $limit = 10)
	{
		return Reply::where('user_id', '=', $user_id)->with('topic')->limit($limit)->get();
	}

	public static function userRepliesWithPagination($user_id, $limit = 20)
	{
		return Reply::where('user_id', '=', $user_id)
						->orderBy('created_at', 'desc')
						->with('topic')
						->paginate($limit);
	}

}