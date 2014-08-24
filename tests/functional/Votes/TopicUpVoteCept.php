<?php
/**
 * ------------------------------------
 *          话题投票 up
 * ------------------------------------
 */

$I = new FunctionalTester($scenario);
Route::enableFilters();

$I->wantTo('UP Vote a Topic as a visitor and a menber.');

$topic = $I->postATopic(['title' => 'My Awsome Topic.']);

// --------------- As a visitor --------------
$I->am('as a Visitor');

$I->amOnRoute('topics.show', $topic->id);
$I->click('#up-vote');

$I->seeCurrentUrlEquals('/login-required');

// --------------- As a member --------------
$user = $I->signIn();
$I->am('as a Member');

$I->amOnRoute('topics.show', $topic->id);
$I->seeElement('#up-vote');

$I->click('#up-vote');
$I->see('My Awsome Topic.');

$I->seeRecord('topics', [
    'id' => $topic->id,
    'vote_count' => 1
]);
