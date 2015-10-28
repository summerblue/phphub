<?php

class AccessToken extends \Eloquent {
	protected $table = 'oauth_access_tokens';
	protected $fillable = [];

	public function session()
	{
		return $this->belongsTo('OAuthSession', 'session_id');
	}
}