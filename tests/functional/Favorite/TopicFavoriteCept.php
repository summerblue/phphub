<?php

/**
 * ------------------------------------
 *          收藏话题
 * ------------------------------------
 */

$I = new FunctionalTester($scenario);
Route::enableFilters();

$I->wantTo('Favorite a Topic as a visitor and a menber.');

$topic = $I->postATopic(['title' => 'My Awsome Topic.']);

// --------------- As a visitor --------------
$I->am('as a Visitor');

$I->amOnRoute('topics.show', $topic->id);
$I->click('#topic-favorite-button');

$I->seeCurrentUrlEquals('/login-required');

// --------------- As a member --------------
$user = $I->signIn();
$I->am('as a Member');

// -- favorite
$I->amOnRoute('topics.show', $topic->id);
$I->seeElement('#topic-favorite-button');

$I->click('#topic-favorite-button');
$I->see('My Awsome Topic.');

$I->seeRecord('favorites', [
    'topic_id' => $topic->id,
    'user_id' => $user->id
]);

// -- cancel favorite
$I->amOnRoute('topics.show', $topic->id);
$I->seeElement('#topic-favorite-cancel-button');

$I->click('#topic-favorite-cancel-button');
$I->see('My Awsome Topic.');

$I->dontSeeRecord('favorites', [
    'topic_id' => $topic->id,
    'user_id' => $user->id
]);
