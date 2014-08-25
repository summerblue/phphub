<?php

/**
 * ------------------------------------
 *          Testing User index
 * ------------------------------------
 */

$I = new FunctionalTester($scenario);
$I->am('a Phphub member');
$I->wantTo('List all the user are registered for PHPHUB');

$user = $I->have('User', [
    'name' => 'SuperMeOriganal',
    'created_at' => Carbon::now()->toDateTimeString()
]);

$I->seeRecord('users', [
    'id' => $user->id
]);

$I->amOnRoute('users.index');

$I->seeElement('.users-index-'.$user->id);
