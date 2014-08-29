<?php

use Laracasts\Presenter\PresentableTrait;

class Notification extends \Eloquent
{
    use PresentableTrait;
    public $presenter = 'Phphub\Presenters\NotificationPresenter';

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
	 * @param  array   $users   to who, array of users
	 * @param  Topic  $topic    cuurent context
	 * @param  Reply  $reply    the content
	 * @return [type]           none
	 */
	public static function batchNotify($type, User $fromUser, $users, Topic $topic, Reply $reply = null)
	{
		$nowTimestamp = Carbon::now()->toDateTimeString();
		$data = [];

		foreach ($users as $toUser)
		{
			if ($fromUser->id == $toUser->id)
				continue;

			$data[] = [
				'from_user_id' => $fromUser->id,
				'user_id'      => $toUser->id,
				'topic_id'     => $topic->id,
				'reply_id'     => $reply->id,
				'body'         => $reply->body,
				'type'         => $type,
				'created_at'   => $nowTimestamp,
				'updated_at'   => $nowTimestamp
			];

			$toUser->increment('notification_count', 1);
		}

        if (count($data)) {
            Notification::insert($data);
        }
	}

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at','desc');
    }

    public static function notify($type, User $fromUser, User $toUser, Topic $topic, Reply $reply = null)
    {
        if ($fromUser->id == $toUser->id)
            return;

        $nowTimestamp = Carbon::now()->toDateTimeString();


        $data[] = [
            'from_user_id' => $fromUser->id,
            'user_id'      => $toUser->id,
            'topic_id'     => $topic->id,
            'reply_id'     => $reply ? $reply->id : 0,
            'body'         => $reply ? $reply->body : '',
            'type'         => $type,
            'created_at'   => $nowTimestamp,
            'updated_at'   => $nowTimestamp
        ];

        $toUser->increment('notification_count', 1);

        Notification::insert($data);
    }

}
