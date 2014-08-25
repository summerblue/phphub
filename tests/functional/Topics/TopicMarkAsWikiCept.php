<?php

/**
 * ------------------------------------
 * 			挑选话题为社区 Wiki
 * ------------------------------------
 */

$I = new FunctionalTester($scenario);

Route::enableFilters();

$I->wantTo('Mark a topic as Community Wiki being a visitor, normal member and admin.');

$topic = $I->postATopic(['title' => 'My Awsome Topic.']);

// Testing as a visitor
$I->am('a Phphub visitor');
$I->amOnRoute('topics.show', $topic->id);
$I->dontSeeElement('#topic-wiki-button');

$I->amOnRoute('topics.wiki', $topic->id);
$I->seeCurrentRouteIs('login-required');

// Test as a normal member
$I->am('a Phphub member');
$I->signIn();

$I->amOnRoute('topics.show', $topic->id);
$I->dontSeeElement('#topic-wiki-button');

$I->amOnRoute('topics.wiki', $topic->id );
$I->seeCurrentRouteIs('admin-required');

// Testing as a admin user
$I->am('a Phphub admin');
$I->signInAsAdmin();

$I->amOnRoute('topics.show', $topic->id);
$I->seeElement('#topic-wiki-button');
$I->click('#topic-wiki-button');

// Succeed
$I->seeElement('.ribbon-wiki');

$I->seeRecord('topics', [
    'id' => $topic->id,
    'is_wiki' => true
]);
