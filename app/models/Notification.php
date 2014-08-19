<?php

class Notification extends \Eloquent 
{
	// Don't forget to fill this array
	protected $fillable = [
			'from_user_id',
			'user_id',
			'topic_id',
			'reply_id',
			'body',
			'type'
			];

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function topic()
	{
		return $this->belongsTo('Topic');
	}

	public function fromUser()
	{
		return $this->belongsTo('User', 'from_user_id');
	}

	/**
	 * Create a notification
	 * @param  [type] $type     currently have 'at', 'new_reply', 'attention'
	 * @param  User   $fromUser come from who
	 * @param  User   $toUser   to who
	 * @param  Topic  $topic    cuurent context
	 * @param  Reply  $reply    the content
	 * @return [type]           none
	 */
	public static function notify($type, User $fromUser, User $toUser, Topic $topic, Reply $reply = null)
	{
		if ($fromUser->id == $toUser->id) 
			return;

		$data = [
			'from_user_id' => $fromUser->id,
			'user_id'      => $toUser->id,
			'topic_id'     => $topic->id,
			'reply_id'     => $reply->id,
			'body'         => $reply->body,
			'type'         => $type,
		];

		Notification::create($data);

		$toUser->notifications++;
		$toUser->save();
	}
}