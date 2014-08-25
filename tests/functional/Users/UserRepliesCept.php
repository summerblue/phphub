<?php

/**
 * ------------------------------------
 *          User replies
 * ------------------------------------
 */

$I = new FunctionalTester($scenario);
Route::enableFilters();

$I->wantTo('Visit a users.replies as a Visitor and as a Member.');

$user = $I->have('User');
$topic = $I->postATopic(['title' => 'My Awsome Topic.']);

$data = [
    'body'     => 'My Awsome Reply.',
    'topic_id' => $topic->id,
    'user_id'  => $user->id
];

$reply = $I->have('Reply', $data);

// --------------- As a visitor --------------
$I->am('as a Visitor');

$I->amOnRoute('users.replies', $user->id);
$I->see('My Awsome Topic.');
$I->see('My Awsome Reply.');

// --------------- As a member --------------
$I->am('as a Member');
$I->signIn();

$I->amOnRoute('users.replies', $user->id);
$I->see('My Awsome Topic.');
$I->see('My Awsome Reply.');
