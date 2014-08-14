<?php

use Phphub\Github\GithubAuthenticatorListener;
use Phphub\User\UserCreatorListener;

class AuthController extends BaseController implements GithubAuthenticatorListener, UserCreatorListener
{
    /**
     * Authenticate with github
     */
    public function login()
    {
        // Redirect from Github 
        if (Input::has('code')) 
        {
            return App::make('Phphub\Github\GithubAuthenticator')->authByCode($this, Input::get('code'));
        }

        // redirect to the github authentication url
        return Redirect::to((string) OAuth::consumer('GitHub')->getAuthorizationUri());
    }

    public function logout()
    {
        Auth::logout();
        Flash::success('成功退出.');
        return Redirect::route('home');
    }

    public function loginRequired()
    {
        return View::make('auth.loginrequired');
    }

    public function adminRequired()
    {
        return View::make('auth.adminrequired');
    }

    /**
     * Shows a user what their new account will look like.
     */
    public function create()
    {
        if ( ! Session::has('userGithubData')) 
        {
            return Redirect::route('login');
        }
        $githubUser = Session::get('userGithubData');

        return View::make('auth.signupconfirm', compact('githubUser'));
    }

    /**
     * Actually creates the new user account
     */
    public function store()
    {
        if ( ! Session::has('userGithubData')) 
        {
            return Redirect::route('login');
        }
        return App::make('Phphub\User\UserCreator')->create($this, Session::get('userGithubData'));
    }


    /**
     * ----------------------------------------
     * UserCreatorListener Delegate
     * ----------------------------------------
     */

    public function userValidationError($errors)
    {
        return Redirect::to('/');
    }

    public function userCreated($user)
    {
        Auth::login($user, true);
        Session::forget('userGithubData');

        Flash::success('恭喜, 你已经成功加入 Phphub.');

        return Redirect::intended();
    }

    /**
     * ----------------------------------------
     * GithubAuthenticatorListener Delegate
     * ----------------------------------------
     */

    // 数据库找不到用户, 执行新用户注册
    public function userNotFound($githubData)
    {
        Session::put('userGithubData', $githubData);
        return Redirect::route('signup');
    }

    // 数据库有用户信息, 登录用户
    public function userFound($user)
    {
        Auth::login($user, true);
        Session::forget('userGithubData');

        Flash::success('成功登录.');

        return Redirect::intended();
    }

    // 用户屏蔽
    public function userIsBanned($user)
    {
        return Redirect::route('home');
    }
}
