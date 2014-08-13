<?php namespace Phphub\Topic;

use Laracasts\Presenter\Presenter;
use Input, URL;

class TopicPresenter extends Presenter
{
    public function topicFilter($filter)
    {
        $query_append = '';
        if ( !empty(Input::except('filter')) ) 
        {
            $query_append = '&'.http_build_query(Input::except('filter')); 
        }
            
        return URL::to('topics') . '?filter=' . $filter . $query_append;
    }

    public function getTopicFilter() 
    {
        $filters = ['noreply', 'vote', 'excellent','recent'];
        $request_filter = Input::get('filter');
        if ( in_array($request_filter, $filters) ) 
        {
            return $request_filter;
        }
        return 'recent';
    }

}