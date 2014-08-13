<?php namespace Phphub\User;

interface UserCreatorListener
{
    public function userValidationError($errors);
    public function userCreated($user);
}