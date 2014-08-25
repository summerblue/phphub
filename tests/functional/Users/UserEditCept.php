<?php

/**
 * ------------------------------------
 *          User editing
 * ------------------------------------
 */

$I = new FunctionalTester($scenario);
Route::enableFilters();

$I->wantTo('Editing user profile as a Visitor and the Owner.');

$user = $I->have('User');

// --------------- As a visitor --------------
$I->am('as a Visitor');

$I->amOnRoute('users.show', $user->id);
$I->dontSeeElement('#user-edit-button');

$I->amOnRoute('users.edit', $user->id);
$I->seeCurrentRouteIs('login-required');

// --------------- As a member --------------
$user = $I->signIn();
$I->am('as the Owner');

$I->amOnRoute('users.show', $user->id);
$I->seeElement('#user-edit-button');

$I->click('#user-edit-button');

$I->seeCurrentRouteIs('users.edit', $user->id);

$I->fillField(['name' => 'city'], 'My city');
$I->fillField(['name' => 'company'], 'My company');
$I->fillField(['name' => 'twitter_account'], 'My twitter_account');
$I->fillField(['name' => 'personal_website'], 'My personal_website');
$I->fillField(['name' => 'signature'], 'My signature');
$I->fillField(['name' => 'introduction'], 'My introduction');

$I->click('#user-edit-submit');

$I->see('My city');
$I->see('My company');
$I->see('My twitter_account');
$I->see('My personal_website');
$I->see('My signature');
$I->see('My introduction');

