<?php namespace Phphub\Presenters;

use Laracasts\Presenter\Presenter;
use Route;

class NotificationPresenter extends Presenter
{
    public function lableUp()
    {
        switch ($this->type)
        {
            case 'new_reply':
            $lable = trans('template.Your topic have new reply:');
                break;
            case 'attention':
                $lable = trans('template.Attented topic has new reply:');
                break;
            case 'at':
                $lable = trans('template.Mention you At:');
                break;
            case 'topic_favorite':
                $lable = trans('template.Favorited your topic:');
                break;
            case 'topic_attent':
                $lable = trans('template.Attented your topic:');
                break;
            case 'topic_upvote':
                $lable = trans('template.Up Vote your topic');
                break;
            case 'reply_upvote':
                $lable = trans('template.Up Vote your reply');
                break;
            case 'topic_mark_wiki':
                $lable = trans('template.has mark your topic as wiki:');
                break;
            case 'topic_mark_excellent':
                $lable = trans('template.has recomended your topic:');
            break;

            default:
                break;
        }
        return $lable;

    }
}
