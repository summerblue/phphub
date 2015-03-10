<?php namespace Phphub\Sitemap;

use Illuminate\Routing\UrlGenerator;
use Topic;
use Node;

class DataProvider
{
    /**
     * The URL generator instance.
     *
     * @var \Illuminate\Routing\UrlGenerator
     */
    protected $url;

    /**
     * Topic Eloquent Model
     *
     * @var \Topic
     */
    protected $topics;

    /**
     * Node Eloquent Model
     *
     * @var \Node
     */
    protected $node;

    /**
     * Create a new data provider instance.
     *
     * @param  \Illuminate\Routing\UrlGenerator  $url
     * @param  \Topic                            $topics
     * @param  \Node                             $nodes
     * @return void
     */
    public function __construct(UrlGenerator $url, Topic $topics, Node $nodes)
    {
        $this->url    = $url;
        $this->topics = $topics;
        $this->nodes  = $nodes;
    }

    /**
     * Get all the topic to include in the sitemap.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Topic[]
     */
    public function getTopics()
    {
        return $this->topics->recent()->get();
    }

    /**
     * Get the url for the given topic.
     *
     * @param  \Topic  $topic
     * @return string
     */
    public function getTopicUrl($topic)
    {
        return $this->url->route('topics.show', $topic->id);
    }

    /**
     * Get all the nodes to include in the sitemap.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Node[]
     */
    public function getNodes()
    {
        return $this->nodes->orderBy('created_at', 'desc')->get();
    }

    /**
     * Get the url for the given node.
     *
     * @param  \Node $node
     * @return string
     */
    public function getNodeUrl($node)
    {
        return $this->url->route('nodes.show', $node->id);
    }

    /**
     * Get all the static pages to include in the sitemap.
     *
     * @return array
     */
    public function getStaticPages()
    {
        $static = [];

        $static[] = $this->getPage('home', 'daily', '1.0');
        $static[] = $this->getPage('wiki', 'monthly', '0.7');
        $static[] = $this->getPage('users.index', 'weekly', '0.8');
        $static[] = $this->getPage('about', 'monthly', '0.7');

        return $static;
    }

    /**
     * Get the data for the given page.
     *
     * @param  string  $route
     * @param  string  $freq
     * @param  string  $priority
     * @return array
     */
    protected function getPage($route, $freq, $priority)
    {
        $url = $this->url->route($route);

        return compact('url', 'freq', 'priority');
    }
}
