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
$I->amOnPage('/topics/' . $topic->id );
$I->dontSeeElement('#topic-wiki-button');

$I->amOnPage('/topics/wiki/' . $topic->id );
$I->seeCurrentUrlEquals('/login-required');

// Test as a normal member
$I->am('a Phphub member');
$I->signIn();

$I->dontSeeElement('#topic-wiki-button');

$I->amOnPage('/topics/wiki/' . $topic->id );
$I->seeCurrentUrlEquals('/admin-required');

// Testing as a admin user
$I->am('a Phphub admin');
$I->signInAsAdmin();

$I->amOnPage('/topics/' . $topic->id );
$I->seeElement('#topic-wiki-button');
$I->click('#topic-wiki-button');

// Succeed
$I->seeElement('.ribbon-wiki');

