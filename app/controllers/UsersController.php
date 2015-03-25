<?php

class UsersController extends \BaseController
{


    public function __construct(Topic $topic)
    {
        parent::__construct();

        $this->beforeFilter('auth', ['only' => ['edit', 'update', 'destroy']]);
        $this->topic = $topic;
    }

    public function index()
    {
        $users = User::recent()->take(48)->get();
        return View::make('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $topics = Topic::whose($user->id)->recent()->limit(10)->get();
        $replies = Reply::whose($user->id)->recent()->limit(10)->get();
        return View::make('users.show', compact('user', 'topics', 'replies'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->authorOrAdminPermissioinRequire($user->id);
        return View::make('users.edit', compact('user', 'topics', 'replies'));
    }

    public function update($id)
    {
        $user = User::findOrFail($id);
        $this->authorOrAdminPermissioinRequire($user->id);
        $data = Input::only('real_name', 'city', 'company', 'twitter_account', 'personal_website', 'signature', 'introduction');
        App::make('Phphub\Forms\UserUpdateForm')->validate($data);

        $user->update($data);

        Flash::success(lang('Operation succeeded.'));
        return Redirect::route('users.show', $id);
    }

    public function destroy($id)
    {
        $this->authorOrAdminPermissioinRequire($topic->user_id);
    }

    public function replies($id)
    {
        $user = User::findOrFail($id);
        $replies = Reply::whose($user->id)->recent()->paginate(15);
        return View::make('users.replies', compact('user', 'replies'));
    }

    public function topics($id)
    {
        $user = User::findOrFail($id);
        $topics = Topic::whose($user->id)->recent()->paginate(15);
        return View::make('users.topics', compact('user', 'topics'));
    }

    public function favorites($id)
    {
        $user = User::findOrFail($id);
        $topics = $user->favoriteTopics()->paginate(15);
        return View::make('users.favorites', compact('user', 'topics'));
    }

    public function blocking($id)
    {
        $user = User::findOrFail($id);
        $user->is_banned = (!$user->is_banned);
        $user->save();
        return Redirect::route('users.show', $id);
    }

    public function githubApiProxy($username)
    {
        $cache_name = 'github_api_proxy_user_'.$username;

        if(Cache::has($cache_name)){
            return Response::json(Cache::get($cache_name));
        }

        $client = new GuzzleHttp\Client([
            'base_url' => 'https://api.github.com/users/',
        ]);

        $result = $client->get($username . '?' . Request::getQueryString())->json();

        //Cache 1 day
        Cache::put($cache_name, $result, 1440);

        return Response::json($result);
    }
}
