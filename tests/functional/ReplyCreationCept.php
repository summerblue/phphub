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
$I->amOnPage('topics/' . $topic->id );

$I->fillField(['name' => 'body'], 'My first reply body.');
$I->click('#reply-create-submit');

$I->seeCurrentUrlEquals('/login-required');

// Test as a member
$I->am('a Phphub member');
$I->signIn();

// Test Login Redirect
$I->amOnPage('topics/' . $topic->id );

$I->fillField(['name' => 'body'], 'My first reply body.');
$I->click('#reply-create-submit');

$I->see('My first reply body.');
