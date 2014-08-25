<?php

/**
 * ------------------------------------
 * 			话题留言功能测试
 * ------------------------------------
 */

$I = new FunctionalTester($scenario);

Route::enableFilters();

$I->wantTo('Creating a new reply as a visitor and member.');

$topic = $I->have('Topic');

// Test Login Redirect
$I->am('a Phphub visitor');
$I->amOnRoute('topics.show', $topic->id);

$I->fillField(['name' => 'body'], 'My first reply body.');
$I->click('#reply-create-submit');

$I->seeCurrentRouteIs('login-required');


// Test as a member
$I->signIn();
$I->am('as a Phphub member');

$I->amOnRoute('topics.show', $topic->id);
$I->fillField(['name' => 'body'], 'My first reply body.');
$I->click('#reply-create-submit');

$I->see('My first reply body.');
