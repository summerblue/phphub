<?php

use Laracasts\Presenter\PresentableTrait;

class Topic extends \Eloquent 
{
	use PresentableTrait;
	protected $presenter = 'Phphub\Topic\TopicPresenter';

	use SoftDeletingTrait;
    protected $dates = ['deleted_at'];

	// Don't forget to fill this array
	protected $fillable = [
		'title', 
		'body', 
		'user_id', 
		'node_id'
	];

	public function favoritedBy()
	{
		return $this->belongsToMany('User', 'favorites');
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

	public function getRepliesWithLimit($limit = 30)
	{
		return $this->replies()
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
				return $this->orderBy('reply_count', 'asc')->orderBy('created_at', 'desc');
				break;
			case 'vote':
				return $this->orderBy('vote_count', 'desc');
				break;
			case 'excellent':
				return $this->where('is_excellent', '=', true)->orderBy('created_at', 'desc');
				break;
			case 'recent':
			default:
				return $this->orderBy('created_at', 'desc');
				break;
		}
	}

	/**
	 * 边栏同一节点下的话题列表
	 */
	public function getSameNodeTopics($limit = 8)
	{
		return Topic::where('node_id', '=', $this->node_id)
						->orderBy('created_at', 'desc')
						->take($limit)
						->remember(10)
						->get();
	}

	public static function userRecentTopics($user_id, $limit = 10)
	{
		return Topic::where('user_id', $user_id)->with('node')->limit($limit)->get();
	}

	public static function userTopicsWithPagination($user_id, $limit = 20)
	{
		return Topic::where('user_id', '=', $user_id)
						->orderBy('created_at', 'desc')
						->with('node')
						->paginate($limit);
	}
}