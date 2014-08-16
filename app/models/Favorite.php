<?php

class Favorite extends \Eloquent 
{
	protected $fillable = [];

    public function post() 
    {
        return $this->belongs_to('Post');
    }

    public function user()
    {
        return $this->belongs_to('User');
    }

    public static function isUserFavoritedTopic(User $user, Topic $topic)
    {
    	return Favorite::where('user_id', $user->id)
    					->where('topic_id', $topic->id)
    					->first();
    }
}