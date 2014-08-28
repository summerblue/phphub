<?php

/**
 * ------------------------------------
 * 			Topic creation
 * ------------------------------------
 */

$I = new FunctionalTester($scenario);

Route::enableFilters();

$I->wantTo('Creating a new topic as a visitor and member.');

// Test Login Redirect
$I->am('a Phphub visitor');
$I->amOnRoute('topics.create');
$I->seeCurrentRouteIs('login-required');

// Test as a member
$I->signIn();
$I->am('as a Phphub member');
$I->amOnRoute('topics.create');

$I->selectOption('form select[name=node_id]', 'php');
$I->fillField(['name' => 'title'], 'My first post!');
$I->fillField(['name' => 'body'], 'My first post body.');

$I->click('#topic-create-submit');

$I->see('My first post!');
