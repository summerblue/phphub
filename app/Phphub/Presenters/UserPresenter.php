<?php namespace Phphub\Presenters;

use Laracasts\Presenter\Presenter;
use Route;
use Config;
use User;
use Role;

class UserPresenter extends Presenter
{
    /**
     * Present a link to the user gravatar.
     */
    public function gravatar($size = 80)
    {
        if (Config::get('app.url_static')) {
            //Using Qiniu image processing service.
            return cdn('uploads/avatars/'.$this->avatar)."?imageView2/1/w/{$size}/h/{$size}";
        }

        $github_id = $this->github_id;
        $domainNumber = rand(0, 3);

        return "https://avatars{$domainNumber}.githubusercontent.com/u/{$github_id}?v=2&s={$size}";
    }

    public function userinfoNavActive($anchor)
    {
        return Route::currentRouteName() == $anchor ? 'active' : '';
    }

    public function hasBadge()
    {
        $relations = Role::relationArrayWithCache();
        $user_ids = array_pluck($relations, 'user_id');
        return in_array($this->id, $user_ids);
    }

    public function badgeName()
    {
        $relations = Role::relationArrayWithCache();
        $relation = array_first($relations, function($key, $value)
        {
            return $value->user_id == $this->id;
        });

        if (!$relation) {
            return;
        }

        $roles = Role::rolesArrayWithCache();

        $role = array_first($roles, function($key, $value) use( &$relation)
        {
            return $value->id == $relation->role_id;
        });


        return $role->name;
    }
}
