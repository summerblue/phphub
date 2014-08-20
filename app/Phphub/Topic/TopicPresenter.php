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
            
        $link = URL::to('topics') . '?filter=' . $filter . $query_append;

        if (Input::get('filter'))
        {
            $selected = Input::get('filter') == $filter ? ' class="selected"':'';       
        }
        else 
        {
            $selected = $filter == 'recent' ? 'class="selected"':'';
        }

        return 'href="' . $link . '"' . $selected;
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

    public function haveDefaultNode($node, $snode)
    {
        if (count($node) && ($snode && $node->id == $snode->id )) 
        {
            return true;
        }

        if (Input::old('node_id') && ( $snode && Input::old('node_id') == $snode->id))
        {
            return true;
        }
        return false;
    }

    public function voteState($vote_type)
    {
        if ($this->votes()->ByWhom(Auth::user()->id)->WithType($vote_type)->count()) 
        {
            return 'active';
        }
        else 
        {
            return;
        }
    }

}