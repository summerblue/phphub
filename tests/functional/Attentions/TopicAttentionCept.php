<?php
/**
 * ------------------------------------
 *          Attenting a topic
 * ------------------------------------
 */

$I = new FunctionalTester($scenario);
Route::enableFilters();

$I->wantTo('Attent a Topic discussion as a visitor and a menber.');

$topic = $I->postATopic(['title' => 'My Awsome Topic.']);

// --------------- As a visitor --------------
$I->am('as a Visitor');

$I->amOnRoute('topics.show', $topic->id);
$I->click('#topic-attent-button');

$I->seeCurrentUrlEquals('/login-required');

// --------------- As a member --------------
$user = $I->signIn();
$I->am('as a Member');

// -- attent
$I->amOnRoute('topics.show', $topic->id);
$I->seeElement('#topic-attent-button');

$I->click('#topic-attent-button');
$I->see('My Awsome Topic.');

$I->seeRecord('attentions', [
    'topic_id' => $topic->id,
    'user_id' => $user->id
]);

// -- cancel attent
$I->amOnRoute('topics.show', $topic->id);
$I->seeElement('#topic-attent-cancel-button');

$I->click('#topic-attent-cancel-button');
$I->see('My Awsome Topic.');

$I->dontSeeRecord('attentions', [
    'topic_id' => $topic->id,
    'user_id' => $user->id
]);
