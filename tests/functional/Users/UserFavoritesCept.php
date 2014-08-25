<?php

/**
 * ------------------------------------
 *          User favorites
 * ------------------------------------
 */

$I = new FunctionalTester($scenario);
Route::enableFilters();

$I->wantTo('Visit a users.favorites as a Visitor and as a Member.');

$user = $I->have('User');
$topic = $I->postATopic(['title' => 'My Awsome Topic.']);

$favorite = $I->have('Favorite', ['user_id' => $user->id, 'topic_id' => $topic->id]);

// --------------- As a visitor --------------
$I->am('as a Visitor');

$I->amOnRoute('users.favorites', $user->id);
$I->see('My Awsome Topic.');

// --------------- As a member --------------
$I->am('as a Member');
$I->signIn();

$I->amOnRoute('users.favorites', $user->id);
$I->see('My Awsome Topic.');
