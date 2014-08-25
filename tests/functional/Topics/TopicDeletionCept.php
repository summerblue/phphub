<?php

/**
 * ------------------------------------
 * 			删除话题
 * ------------------------------------
 */

$I = new FunctionalTester($scenario);

Route::enableFilters();

$I->wantTo('Delete a topic as a visitor, normal member and admin.');
$topic = $I->postATopic(['title' => 'My Awsome Topic.']);

// Testing as a visitor
$I->am('a Phphub visitor');
$I->amOnRoute('topics.show', $topic->id);
$I->dontSeeElement('#topic-delete-button');

$I->amOnRoute('topics.delete', $topic->id );
$I->seeCurrentRouteIs('login-required');

// Test as a normal member
$I->am('a Phphub member');
$I->signIn();
$I->amOnRoute('topics.show', $topic->id);
$I->dontSeeElement('#topic-delete-button');
$I->amOnRoute('topics.delete', $topic->id );
$I->seeCurrentRouteIs('admin-required');

// Testing as a admin user
$I->am('a Phphub admin');
$I->signInAsAdmin();

$I->amOnRoute('topics.show', $topic->id);
$I->seeElement('#topic-delete-button');
$I->click('#topic-delete-button');

$I->seeCurrentRouteIs('topics');

$I->dontSeeRecord('topics', [
    'id' => $topic->id
]);
