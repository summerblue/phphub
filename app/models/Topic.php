<?php

use Laracasts\Presenter\PresentableTrait;

class Topic extends \Eloquent
{
	// manually maintian
	public $timestamps = false;

	use PresentableTrait;
	protected $presenter = 'Phphub\Presenters\TopicPresenter';

	use SoftDeletingTrait;
    protected $dates = ['deleted_at'];

	// Don't forget to fill this array
	protected $fillable = [
		'title',
        'body',
        'excerpt',
		'body_original',
		'user_id',
		'node_id',
		'created_at',
		'updated_at'
	];

    public static function boot()
    {
        parent::boot();

        static::created(function($topic)
        {
            SiteStatus::newTopic();
        });
    }

	public function votes()
	{
		return $this->morphMany('Vote', 'votable');
	}

	public function favoritedBy()
	{
		return $this->belongsToMany('User', 'favorites');
	}

	public function attentedBy()
	{
		return $this->belongsToMany('User', 'attentions');
	}

	public function node()
	{
		return $this->belongsTo('Node');
	}

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function lastReplyUser()
	{
		return $this->belongsTo('User', 'last_reply_user_id');
	}

	public function replies()
	{
		return $this->hasMany('Reply');
	}

	public function getWikiList()
	{
		return $this->where('is_wiki', '=', true)->orderBy('created_at', 'desc')->get();
	}

    public function generateLastReplyUserInfo()
    {
        $lastReply = $this->replies()->recent()->first();

        $this->last_reply_user_id = $lastReply ? $lastReply->user_id : 0;
        $this->save();
    }

	public function getRepliesWithLimit($limit = 30)
	{
		return $this->replies()
					->orderBy('vote_count', 'desc')
					->orderBy('created_at', 'asc')
					->with('user')
					->paginate($limit);
	}

	public function getTopicsWithFilter($filter, $limit = 20)
	{
		return $this->applyFilter($filter)
					->with('user', 'node', 'lastReplyUser')
					->paginate($limit);
	}

	public function getNodeTopicsWithFilter($filter, $node_id, $limit = 20)
	{
		return $this->applyFilter($filter)
					->where('node_id', '=', $node_id)
					->with('user', 'node', 'lastReplyUser')
					->paginate($limit);
	}

	public function applyFilter($filter)
	{
		switch ($filter) {
			case 'noreply':
				return $this->orderBy('reply_count', 'asc')->recent();
				break;
			case 'vote':
				return $this->orderBy('vote_count', 'desc')->recent();
				break;
			case 'excellent':
				return $this->excellent()->recent();
				break;
			case 'recent':
				return $this->recent();
				break;
			default:
				return $this->pin()->recentReply();
				break;
		}
	}

	/**
	 * 边栏同一节点下的话题列表
	 */
	public function getSameNodeTopics($limit = 8)
	{
		return Topic::where('node_id', '=', $this->node_id)
						->recent()
						->take($limit)
						->remember(10)
						->get();
	}

	public function scopeWhose($query, $user_id)
	{
        return $query->where('user_id','=',$user_id)->with('node');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at','desc');
    }

    public function scopePin($query)
    {
        return $query->orderBy('order','desc');
    }

    public function scopeRecentReply($query)
    {
        return $query->where('created_at', '>', Carbon::today()->subMonth())->orderBy('updated_at', 'desc');
    }

    public function scopeExcellent($query)
    {
        return $query->where('is_excellent', '=', true);
    }

    public static function makeExcerpt($body)
    {
        $html = $body;
        $excerpt = trim(preg_replace('/\s\s+/', ' ', strip_tags($html)));
        return str_limit($excerpt, 200);
    }
}
