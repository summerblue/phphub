<?php
/**
 * ------------------------------------
 *          话题投票 Down
 * ------------------------------------
 */

$I = new FunctionalTester($scenario);
Route::enableFilters();

$I->wantTo('Down Vote Topic as a visitor and a menber.');

$topic = $I->postATopic(['title' => 'My Awsome Topic.']);

// --------------- As a visitor --------------
$I->am('as a Visitor');

$I->amOnRoute('topics.show', $topic->id);
$I->click('#down-vote');

$I->seeCurrentUrlEquals('/login-required');

// --------------- As a member --------------
$user = $I->signIn();
$I->am('as a Member');

$I->amOnRoute('topics.show', $topic->id);
$I->seeElement('#down-vote');

$I->click('#down-vote');
$I->see('My Awsome Topic.');

$I->seeRecord('topics', [
    'id' => $topic->id,
    'vote_count' => -1
]);
