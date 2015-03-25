<?php namespace Phphub\Presenters;

use Laracasts\Presenter\Presenter;
use Route;

class UserPresenter extends Presenter
{
    /**
     * Present a link to the user gravatar
     */
    public function gravatar($size = 80)
    {
        return cdn('uploads/avatars/' . $this->avatar) . "?imageView2/1/w/{$size}/h/{$size}";
    }

    public function userinfoNavActive($anchor)
    {
        return Route::currentRouteName() == $anchor ? 'active' : '';
    }
}
