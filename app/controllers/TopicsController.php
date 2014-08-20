<?php

use Phphub\Core\CreatorListener;
use Phphub\Forms\TopicCreationForm;

class TopicsController extends \BaseController implements CreatorListener 
{
    protected $topic;

	public function __construct(Topic $topic)
    {
        $this->beforeFilter('auth', ['except' => ['index', 'show']]);
        $this->topic = $topic;
    }

	public function index()
	{
		$filter = $this->topic->present()->getTopicFilter();
		$topics = $this->topic->getTopicsWithFilter($filter);
		$nodes  = Node::allLevelUp();
		$links  = Link::remember(1440)->get();

		return View::make('topics.index', compact('topics', 'nodes', 'links'));
	}

	public function create()
	{
		$node = Node::find(Input::get('node_id'));
		$nodes = Node::allLevelUp();

		return View::make('topics.create', compact('nodes', 'node'));
	}

	public function store()
	{
		return App::make('Phphub\Topic\TopicCreator')->create($this, Input::except('_token'));
	}

	public function show($id)
	{
		$topic = Topic::findOrFail($id);
		$replies = $topic->getRepliesWithLimit();
		$node = $topic->node;
		$nodeTopics = $topic->getSameNodeTopics();

        $topic->increment('view_count', 1);

		return View::make('topics.show', compact('topic', 'replies', 'nodeTopics', 'node'));
	}

	public function edit($id)
	{
		$topic = Topic::findOrFail($id);
		$this->authorOrAdminPermissioinRequire($topic);
		$nodes = Node::allLevelUp();
		$node = $topic->node;

		return View::make('topics.create', compact('topic', 'nodes', 'node'));
	}

	public function update($id)
	{
		$topic = Topic::findOrFail($id);
		$data = Input::only('title', 'body', 'node_id');

		$this->authorOrAdminPermissioinRequire($topic);
		
        // Validation
		App::make('Phphub\Forms\TopicCreationForm')->validate($data);

		$topic->update($data);

		Flash::success('话题更新成功.');
		return Redirect::route('topics.show', $topic->id);
	}

    /**
     * ----------------------------------------
     * User Topic Vote function
     * ----------------------------------------
     */
    
	public function upvote($id)
	{
		$topic = Topic::find($id);
		App::make('Phphub\Vote\Voter')->topicUpVote($topic);
		return Redirect::back();
	}

	public function downvote($id)
	{
		$topic = Topic::find($id);
		App::make('Phphub\Vote\Voter')->topicDownVote($topic);
		return Redirect::back();
	}

    /**
     * ----------------------------------------
     * Admin Topic Management
     * ----------------------------------------
     */
    
	public function recomend($id)
	{
		$topic = Topic::findOrFail($id);
		$topic->is_excellent = (!$topic->is_excellent);
		$topic->save();

		$message = $topic->is_excellent ? '成功推荐话题' : '成功取消话题推荐';
		Flash::success($message);

		return Redirect::route('topics.show', $topic->id);
	}

	public function wiki($id)
	{
		$topic = Topic::findOrFail($id);
		$topic->is_wiki = (!$topic->is_wiki);
		$topic->save();

		$message = $topic->is_wiki ? '成功加入Wiki' : '成功取消Wiki';
		Flash::success($message);

		return Redirect::route('topics.show', $topic->id);
	}

	public function delete($id)
	{
		$topic = Topic::find($id);
		$topic->delete();
		Flash::success("成功放入垃圾箱.");

		return Redirect::route('topics.index');
	}

    /**
     * ----------------------------------------
     * CreatorListener Delegate
     * ----------------------------------------
     */

    public function creatorFailed($errors)
    {
        return Redirect::to('/');
    }

    public function creatorSucceed($topic)
    {
        Flash::success('话题创建成功.');

        return Redirect::route('topics.show', array($topic->id));
    }

}
