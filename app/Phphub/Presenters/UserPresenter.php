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
        $github_id = $this->github_id;
        $domainNumber = rand(0, 3);
        return "https://avatars{$domainNumber}.githubusercontent.com/u/{$github_id}?v=2&s={$size}";
    }

    public function userinfoNavActive($anchor)
    {
        return Route::currentRouteName() == $anchor ? 'active' : '';
    }
}
