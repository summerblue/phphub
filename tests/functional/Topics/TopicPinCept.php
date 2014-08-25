<?php
/**
 * ------------------------------------
 *          话题置顶功能
 * ------------------------------------
 */

$I = new FunctionalTester($scenario);

Route::enableFilters();

$I->wantTo('Pin a topic on Top of the topic default list');
$topic = $I->postATopic(['title' => 'My Awsome Topic.']);

// Testing as a visitor
$I->am('a Phphub visitor');
$I->amOnRoute('topics.show', $topic->id);
$I->dontSeeElement('#topic-pin-button');
$I->amOnRoute('topics.pin', $topic->id);
$I->seeCurrentRouteIs('login-required');

// Test as a normal member
$I->am('a Phphub member');
$I->signIn();
$I->amOnRoute('topics.show', $topic->id);
$I->dontSeeElement('#topic-pin-button');
$I->amOnRoute('topics.pin', $topic->id);
$I->seeCurrentRouteIs('admin-required');

// Testing as a admin user
$I->am('a Phphub admin');
$I->signInAsAdmin();
$I->amOnRoute('topics.show', $topic->id);
$I->seeElement('#topic-pin-button');
$I->click('#topic-pin-button');

// check the list
$I->amOnRoute('topics.index');
$I->seeElement('#pin-' . $topic->id);

$I->seeRecord('topics', [
    'id' => $topic->id,
    'order' => 1
]);
