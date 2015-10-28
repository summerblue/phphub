<?php

class OAuthSession extends \Eloquent {
	protected $table = 'oauth_sessions';
	protected $fillable = [];

	public function user(){
		return $this->belongsTo('User', 'owner_id');
	}

	public function token(){
		return $this->hasOne('AccessToken', 'session_id');
	}
}