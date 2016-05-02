<?php

class PagesController extends \BaseController
{

    protected $topic;

    public function __construct(Topic $topic)
    {
        parent::__construct();
        $this->topic = $topic;
    }

    /**
     * The home page
     */
    public function home()
    {
        $topics = $this->topic->getTopicsWithFilter('excellent');
        $nodes  = Node::allLevelUp();

        return View::make('pages.home', compact('topics', 'nodes'));
    }

    /**
     * About us page
     */
    public function about()
    {
        return View::make('pages.about');
    }

    /**
     * Community WIKI
     */
    public function wiki()
    {
        $topics = $this->topic->getWikiList();
        return View::make('pages.wiki', compact('topics'));
    }

    /**
     * Search page, using google's.
     */
    public function search()
    {
        $query = Purifier::clean(Input::get('q'));
        return Redirect::away('https://www.bing.com/search?q=site:phphub.org ' . $query, 301);
    }

    /**
     * Feed function
     */
    public function feed()
    {
        $topics = Topic::excellent()->recent()->limit(20)->get();

        $channel =[
            'title' => 'PHPhub - PHP & Laravel的中文社区',
            'description' => 'PHPhub是 PHP 和 Laravel 的中文社区，在这里我们讨论技术, 分享技术。',
            'link' => URL::route('feed')
        ];

        $feed = Rss::feed('2.0', 'UTF-8');

        $feed->channel($channel);

        foreach ($topics as $topic) {
            $feed->item([
                'title' => $topic->title,
                'description|cdata' => str_limit($topic->body, 200),
                'link' => URL::route('topics.show', $topic->id),
                'pubDate' => date('Y-m-d', strtotime($topic->created_at)),
                ]);
        }

        return Response::make($feed, 200, array('Content-Type' => 'text/xml'));
    }

    /**
     * Sitemap function
     */
    public function sitemap()
    {
        return App::make('Phphub\Sitemap\Builder')->render();
    }
}
