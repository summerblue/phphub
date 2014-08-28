<?php

/**
 * ------------------------------------
 * 			Mark a topic as exellent
 * ------------------------------------
 */

$I = new FunctionalTester($scenario);

Route::enableFilters();

$I->wantTo('Recomend a topic to the home page as a visitor, normal member and admin.');
$topic = $I->postATopic(['title' => 'My Awsome Topic.']);

// Testing as a visitor
$I->am('a Phphub visitor');
$I->amOnRoute('topics.show', $topic->id );
$I->dontSeeElement('#topic-recomend-button');
$I->amOnRoute('topics.recomend', $topic->id );
$I->seeCurrentRouteIs('login-required');

// Test as a normal member
$I->am('a Phphub member');
$I->signIn();
$I->amOnRoute('topics.show', $topic->id );
$I->dontSeeElement('#topic-recomend-button');
$I->amOnRoute('topics.recomend', $topic->id );
$I->seeCurrentRouteIs('admin-required');

// Testing as a admin user
$I->am('a Phphub admin');
$I->signInAsAdmin();
$I->amOnRoute('topics.show', $topic->id );
$I->seeElement('#topic-recomend-button');
$I->click('#topic-recomend-button');

// Succeed
$I->seeElement('.ribbon-excellent');

$I->seeRecord('topics', [
    'id' => $topic->id,
    'is_excellent' => true
]);
