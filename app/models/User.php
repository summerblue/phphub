<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Laracasts\Presenter\PresentableTrait;

class User extends Eloquent implements UserInterface, RemindableInterface
{
    use PresentableTrait;

    const STATE_ACTIVE  = 1;
    const STATE_BLOCKED = 2;

    protected $table      = 'users';
    protected $hidden     = ['github_id'];
    protected $fillable   = ['email', 'name', 'github_url', 'github_id', 'image_url', 'is_banned'];
    protected $softDelete = true;

    public $presenter = 'Phphub\User\UserPresenter';

    protected $validationRules = [
        'github_id' => 'unique:users,github_id,<id>',
    ];

    private $rolesCache;

    public function topics() {
        $this->hasMany('Topic');
    }
    
    public function getByGithubId($id)
    {
        return $this->where('github_id', '=', $id)->first();
    }

    // Articles
    public function articles()
    {
        return $this->hasMany('Phphub\Articles\Article', 'author_id');
    }

    // Roles
    public function roles()
    {
        return $this->belongsToMany('Phphub\User\Role');
    }

    public function getRoles()
    {
        if ( ! isset($this->rolesCache)) {
            $this->rolesCache = $this->roles;
        }

        return $this->rolesCache;
    }

    public function isForumAdmin()
    {
        return $this->hasRole('manage_forum');
    }

    public function setRolesAttribute($roles)
    {
        $this->roles()->sync((array) $roles);
    }

    public function hasRole($roleName)
    {
        return $this->hasRoles($roleName);
    }

    public function hasRoles($roleNames = [])
    {
        $roleList = \App::make('Phphub\User\RoleRepository')->getRoleList();

        foreach ((array) $roleNames as $allowedRole) {
            // validate that the role exists
            if ( ! in_array($allowedRole, $roleList)) {
                throw new InvalidRoleException("Unidentified role: {$allowedRole}");
            }

            // validate that the user has the role
            if ( ! $this->roleCollectionHasRole($allowedRole)) {
                return false;
            }
        }

        return true;
    }

    private function roleCollectionHasRole($allowedRole)
    {
        $roles = $this->getRoles();

        if ( ! $roles) {
            return false;
        }

        foreach ($roles as $role) {
            if (strtolower($role->name) == strtolower($allowedRole)) {
                return true;
            }
        }

        return false;
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

    // Forum
    public function forumPosts()
    {
        return $this->hasMany('Phphub\Comments\Comment', 'author_id')->where('type', '=', \Phphub\Comments\Comment::TYPE_FORUM)->orderBy('created_at', 'desc');
    }

    public function forumThreads()
    {
        return $this->hasMany('Phphub\Forum\Threads\Thread', 'author_id')->orderBy('created_at', 'desc');
    }

    public function forumReplies()
    {
        return $this->hasMany('Phphub\Forum\Replies\Reply', 'author_id')->orderBy('created_at', 'desc');
    }

    public function mostRecentFiveForumPosts()
    {
        return $this->forumPosts()->take(5);
    }

    public function getLatestThreadsPaginated($max = 5)
    {
        return $this->forumThreads()->paginate($max);
    }

    public function getLatestRepliesPaginated($max = 5)
    {
        return $this->forumReplies()->with('thread')->paginate($max);
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
