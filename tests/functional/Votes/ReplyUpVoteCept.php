<?php
/**
 * ------------------------------------
 *          回复投票 up
 * ------------------------------------
 */

$I = new FunctionalTester($scenario);
Route::enableFilters();

$I->wantTo('UP Vote a Reply as a visitor and a menber.');

$topic = $I->postATopic(['title' => 'My Awsome Topic.']);
$reply = $I->have('Reply', ['topic_id' => $topic->id]);

// --------------- As a visitor --------------
$I->am('as a Visitor');

$I->amOnRoute('topics.show', $topic->id);
$I->click('#reply-up-vote-'.$reply->id);

$I->seeCurrentUrlEquals('/login-required');

// --------------- As a member --------------
$user = $I->signIn();
$I->am('as a Member');

$I->amOnRoute('topics.show', $topic->id);
$I->seeElement('#reply-up-vote-'.$reply->id);

$I->click('#reply-up-vote-'.$reply->id);
$I->see('My Awsome Topic.');

$I->seeRecord('replies', [
    'id' => $reply->id,
    'vote_count' => 1
]);
