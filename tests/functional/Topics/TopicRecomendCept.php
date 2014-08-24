<?php

/**
 * ------------------------------------
 * 			推荐话题
 * ------------------------------------
 */

$I = new FunctionalTester($scenario);

Route::enableFilters();

$I->wantTo('Recomend a topic to the home page as a visitor, normal member and admin.');

$topic = $I->postATopic(['title' => 'My Awsome Topic.']);

// Testing as a visitor
$I->am('a Phphub visitor');
$I->amOnPage('/topics/' . $topic->id );
$I->dontSeeElement('#topic-recomend-button');

$I->amOnPage('/topics/recomend/' . $topic->id );
$I->seeCurrentUrlEquals('/login-required');

// Test as a normal member
$I->am('a Phphub member');
$I->signIn();

$I->dontSeeElement('#topic-recomend-button');

$I->amOnPage('/topics/recomend/' . $topic->id );
$I->seeCurrentUrlEquals('/admin-required');

// Testing as a admin user
$I->am('a Phphub admin');
$I->signInAsAdmin();

$I->amOnPage('/topics/' . $topic->id );
$I->seeElement('#topic-recomend-button');
$I->click('#topic-recomend-button');

// Succeed
$I->seeElement('.ribbon-excellent');

