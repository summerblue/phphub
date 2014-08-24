<?php
namespace Codeception\Module;

use Laracasts\TestDummy\Factory as TestDummy;
use Auth, Role, User;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class FunctionalHelper extends \Codeception\Module
{
	public function signIn()
    {
        $user = $this->haveAnAccount();
        $I = $this->getModule('Laravel4');

        // login user
        $I->amLoggedAs($user);
        return $user;
    }

    public function signInAsAdmin()
    {
        $user = $this->haveAnAccount();
        $I = $this->getModule('Laravel4');

        $founder = Role::where('name', 'Founder')->get()->first();
        $user->attachRole($founder);

        // login user
        $I->amLoggedAs($user);
    }

    public function haveAnAccount($overrides = [])
    {
        return $this->have('User', $overrides);
    }

    public function postATopic($overrides= [])
    {
        return $this->have('Topic', $overrides);
    }

    public function have($model, $overrides = [])
    {
        return TestDummy::create($model, $overrides);
    }
}
