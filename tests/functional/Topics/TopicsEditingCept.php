<?php

/**
 * ------------------------------------
 *          话题编辑功能测试
 * ------------------------------------
 */

$I = new FunctionalTester($scenario);
Route::enableFilters();

$I->wantTo('Editing a topic as a Visitor, Member and Author.');

$topic = $I->postATopic(['title' => 'My Awsome Topic.']);

// --------------- As a visitor --------------
$I->am('as a Visitor');

$I->amOnRoute('topics.show', $topic->id);
$I->dontSeeElement('#topic-edit-button');

$I->amOnRoute('topics.edit', $topic->id);
$I->seeCurrentUrlEquals('/login-required');

// --------------- As a member --------------
$user = $I->signIn();
$I->am('as the author');

$topic = $I->postATopic(['title' => 'My Awsome Topic.', 'user_id' => $user->id]);

$I->amOnRoute('topics.show', $topic->id);
$I->seeElement('#topic-edit-button');

$I->click('#topic-edit-button');
$I->selectOption('form select[name=node_id]', 'php');
$I->fillField(['name' => 'title'], 'My first post!');
$I->fillField(['name' => 'body'], 'My first post body.');

$I->click('#topic-create-submit');

$I->see('My first post!');
