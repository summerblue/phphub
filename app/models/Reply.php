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

}