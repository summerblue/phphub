<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Laracasts\Presenter\PresentableTrait;
use Zizaco\Entrust\HasRole;

class User extends \Eloquent implements UserInterface, RemindableInterface
{
    // Using: $user->present()->anyMethodYourWant()
    use PresentableTrait;
    public $presenter = 'Phphub\Presenters\UserPresenter';

    // Enable hasRole( $name ), can( $permission ),
    //   and ability($roles, $permissions, $options)
    use HasRole;

    // Enable soft delete
    use SoftDeletingTrait;
    protected $dates = ['deleted_at'];

    protected $table      = 'users';
    protected $hidden     = ['github_id'];
    protected $guarded    = ['id', 'notifications', 'is_banned'];

    public static function boot()
    {
        parent::boot();

        static::created(function($topic)
        {
            SiteStatus::newUser();
        });
    }

    public function favoriteTopics()
    {
        return $this->belongsToMany('Topic', 'favorites')->withTimestamps();
    }

    public function attentTopics()
    {
        return $this->belongsToMany('Topic', 'attentions')->withTimestamps();
    }

    public function topics()
    {
        return $this->hasMany('Topic');
    }

    public function replies()
    {
        return $this->hasMany('Reply');
    }

    public function notifications()
    {
        return $this->hasMany('Notification')->recent()->with('topic', 'fromUser')->paginate(20);
    }

    public function getByGithubId($id)
    {
        return $this->where('github_id', '=', $id)->first();
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * ----------------------------------------
     * UserInterface
     * ----------------------------------------
     */

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * ----------------------------------------
     * RemindableInterface
     * ----------------------------------------
     */

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
