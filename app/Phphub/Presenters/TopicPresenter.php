<?php namespace Phphub\Presenters;

use Laracasts\Presenter\Presenter;
use Input;
use URL;
use Request;
use Config;

class TopicPresenter extends Presenter
{
    public function topicFilter($filter)
    {
        $node_id = Request::segment(2);
        $node_append = '';
        if ($node_id) {
            $link = URL::to('nodes', $node_id) . '?filter=' . $filter;
        } else {
            $query_append = '';
            $query = Input::except('filter', '_pjax');
            if ($query) {
                $query_append = '&'.http_build_query($query);
            }
            $link = URL::to('topics') . '?filter=' . $filter . $query_append . $node_append;
        }
        $selected = Input::get('filter') ? (Input::get('filter') == $filter ? ' class="selected"':'') : '';

        return 'href="' . $link . '"' . $selected;
    }

    public function getTopicFilter()
    {
        $filters = ['noreply', 'vote', 'excellent','recent'];
        $request_filter = Input::get('filter');
        if (in_array($request_filter, $filters)) {
            return $request_filter;
        }
        return 'default';
    }

    public function haveDefaultNode($node, $snode)
    {
        if (count($node) && ($snode && $node->id == $snode->id)) {
            return true;
        }

        if (Input::old('node_id') && ($snode && Input::old('node_id') == $snode->id)) {
            return true;
        }

        return false;
    }

    public function voteState($vote_type)
    {
        if ($this->votes()->ByWhom(Auth::id())->WithType($vote_type)->count()) {
            return 'active';
        } else {
            return;
        }
    }

    public function replyFloorFromIndex($index)
    {
        $index += 1;
        $current_page = Input::get('page') ?: 1;
        return ($current_page - 1) * Config::get('phphub.replies_perpage') + $index;
    }
}
