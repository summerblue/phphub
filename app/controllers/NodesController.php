<?php

class NodesController extends \BaseController {

	protected $topic;

	public function __construct(Topic $topic)
    {
    	parent::__construct();
    	
        $this->beforeFilter('auth', ['only' => 'create', 'store']);
        $this->topic = $topic;
    }

	public function index()
	{
		$nodes = Node::all();

		return View::make('nodes.index', compact('nodes'));
	}

	public function create()
	{
		return View::make('nodes.create');
	}

	public function store()
	{
		$validator = Validator::make($data = Input::all(), Node::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Node::create($data);

		return Redirect::route('nodes.index');
	}

	public function show($id)
	{
		$node = Node::findOrFail($id);
		$filter = $this->topic->present()->getTopicFilter();
		$topics = $this->topic->getNodeTopicsWithFilter($filter, $id);

		return View::make('topics.index', compact('topics', 'node'));
	}

	public function edit($id)
	{
		$node = Node::find($id);

		return View::make('nodes.edit', compact('node'));
	}

	public function update($id)
	{
		$node = Node::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Node::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$node->update($data);

		return Redirect::route('nodes.index');
	}

	public function destroy($id)
	{
		Node::destroy($id);

		return Redirect::route('nodes.index');
	}

}
