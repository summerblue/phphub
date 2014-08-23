<?php

class PagesController extends \BaseController {

	protected $topic;

	public function __construct(Topic $topic)
    {
    	parent::__construct();
    	
        $this->topic = $topic;
    }

	/**
	 * 首页
	 */
	public function home()
	{
		$topics = $this->topic->getTopicsWithFilter('excellent');
		$nodes  = Node::allLevelUp();

		return View::make('pages.home', compact('topics', 'nodes'));
	}

	/**
	 * 关于我们
	 */
	public function about()
	{
		return View::make('pages.about');
	}

	/**
	 * 社区 WIKI
	 */
	public function wiki()
	{
		$topics = $this->topic->getWikiList();
		return View::make('pages.wiki', compact('topics'));
	}
	
	/**
	 * 搜索功能
	 */
	public function search()
	{
		$query = Security::clean(Input::get('q'));
		return Redirect::away('https://www.google.com/search?q=site:phphub.org ' . $query, 301);
	}
	
	/**
	 * feed
	 */
	public function feed()
	{
	    // creating rss feed with our most recent 20 topicss
	    $topics = Topic::Excellent()->orderBy('created_at', 'desc')->with('user')->limit(30)->get();
	    $feed = Feed::make();

	    // set your feed's title, description, link, pubdate and language
	    $feed->title = 'PHPhub - PHP & Laravel的中文社区';
	    $feed->description = 'PHPhub是 PHP 和 Laravel 的中文社区，在这里我们讨论技术, 分享技术。';
	    $feed->logo = '';
	    $feed->link = URL::route('feed');
	    $feed->pubdate = $topics[0]->created_at;
	    $feed->lang = 'en';

	    foreach ($topics as $topic)
	    {
	        // set item's title, author, url, pubdate, description and content
	        $feed->add(
		        		$topic->title, 
		        		$topic->user->name, 
		        		URL::route('topics.show', $topic->id), 
		        		$topic->created_at, 
		        		$topic->body
	        		);
	    }

	    // show your feed (options: 'atom' (recommended) or 'rss')
	    // return $feed->render('atom');

	    // show your feed with cache for 60 minutes
	    // second param can be integer, carbon or datetime
	    // optional: you can set custom cache key with 3rd param as string
	    return $feed->render('atom', 60);

	    // to return your feed as a string set second param to -1
	    // $xml = $feed->render('atom', -1);
	}


}
