<?php

/**
 * ------------------------------------
 *          User topics
 * ------------------------------------
 */

$I = new FunctionalTester($scenario);
Route::enableFilters();

$I->wantTo('Visit a users.topics as a Visitor and as a Member.');

$user = $I->have('User');
$topic = $I->postATopic(['title' => 'My Awsome Topic.', 'user_id' => $user->id]);

// --------------- As a visitor --------------
$I->am('as a Visitor');

$I->amOnRoute('users.topics', $user->id);
$I->see('My Awsome Topic.');

// --------------- As a member --------------
$I->am('as a Member');
$I->signIn();

$I->amOnRoute('users.topics', $user->id);
$I->see('My Awsome Topic.');
