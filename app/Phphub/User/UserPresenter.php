<?php namespace Phphub\User;

use Laracasts\Presenter\Presenter;
use Route;

class UserPresenter extends Presenter
{
    /**
     * Present a link to the user gravatar
     */
    public function gravatar($size = 30)
    {
        $email = md5($this->email);

        return "//gravatar.com/avatar/{$email}?s={$size}";
    }

    public function userinfoNavActive($anchor)
    {
        return Route::currentRouteName() == $anchor ? 'active' : '';
    }

}