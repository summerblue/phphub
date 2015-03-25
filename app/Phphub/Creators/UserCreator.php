<?php namespace Phphub\Creators;

use Phphub\Forms\UserSignupForm;
use Phphub\Listeners\UserCreatorListener;
use User;

/**
* This class can call the following methods on the observer object:
*
* userValidationError($errors)
* userCreated($user)
*/
class UserCreator
{
    protected $userModel;
    protected $signupForm;

    public function __construct(User $userModel, UserSignupForm $signupForm)
    {
        $this->userModel  = $userModel;
        $this->signupForm = $signupForm;
    }

    public function create(UserCreatorListener $observer, $data)
    {
        // Validation
        $this->signupForm->validate($data);
        return $this->createValidUserRecord($observer, $data);
    }

    private function createValidUserRecord($observer, $data)
    {
        $user = User::create($data);
        if (! $user) {
            return $observer->userValidationError($user->getErrors());
        }
        $user->cacheAvatar();
        return $observer->userCreated($user);
    }
}
