<?php namespace Phphub\Github;

interface GithubAuthenticatorListener
{
    public function userFound($user);
    public function userIsBanned($user);
    public function userNotFound($githubData);
}