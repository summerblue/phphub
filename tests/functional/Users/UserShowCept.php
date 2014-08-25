<?php

/**
 * ------------------------------------
 *          Testing User Show
 * ------------------------------------
 */

$I = new FunctionalTester($scenario);
$I->am('as a visitor');
$I->wantTo('See a user profile.');

$user = $I->have('User', [
    'name' => 'SuperMeOriganal2',
    'created_at' => Carbon::now()->toDateTimeString()
]);

$I->seeRecord('users', [
    'id' => $user->id
]);

$I->amOnRoute('users.show', $user->id);

$I->see('SuperMeOriganal2');
