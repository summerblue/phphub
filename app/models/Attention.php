<?php

class Attention extends \Eloquent
{
    protected $fillable = [];

    public function post()
    {
        return $this->belongsTo('Post');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

    public static function isUserAttentedTopic(User $user, Topic $topic)
    {
        return Attention::where('user_id', $user->id)
                        ->where('topic_id', $topic->id)
                        ->first();
    }
}
