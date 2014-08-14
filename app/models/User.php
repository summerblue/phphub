<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Laracasts\Presenter\PresentableTrait;
use Zizaco\Entrust\HasRole;

class User extends Eloquent implements UserInterface, RemindableInterface
{
    // Using: $user->present()->anyMethodYourWant()
    use PresentableTrait;
    public $presenter = 'Phphub\User\UserPresenter';

    // Enable hasRole( $name ), can( $permission ), 
    //   and ability($roles, $permissions, $options)
    use HasRole;

    const STATE_ACTIVE  = 1;
    const STATE_BLOCKED = 2;

    protected $table      = 'users';
    protected $hidden     = ['github_id'];
    protected $fillable   = ['email', 'name', 'github_url', 'github_id', 'image_url', 'is_banned'];
    protected $softDelete = true;

    public function topics() 
    {
        $this->hasMany('Topic');
    }

    public function getByGithubId($id)
    {
        return $this->where('github_id', '=', $id)->first();
    }

    // UserInterface
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    // RemindableInterface
    public function getReminderEmail()
    {
        return $this->email;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
