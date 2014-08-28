<?php

/**
 * ------------------------------------
 *          Reply deletion
 * ------------------------------------
 */


$I = new FunctionalTester($scenario);

Route::enableFilters();

$I->wantTo('Delete a reply as a visitor, normal member and admin.');

$topic = $I->postATopic(['title' => 'My Awsome Topic.']);
$reply = $I->have('Reply', ['topic_id' => $topic->id]);

// Testing as a visitor
$I->am('as a visitor');
$I->amOnRoute('topics.show', $topic->id);
$I->dontSeeElement('#reply-delete-' . $reply->id);

$I->amOnRoute('topics.delete', $topic->id);
$I->seeCurrentRouteIs('login-required');

// Test as a normal member
$I->am('as a member');
$I->signIn();

$I->dontSeeElement('#reply-delete-' . $reply->id);

$I->amOnRoute('topics.delete', $topic->id);
$I->seeCurrentRouteIs('admin-required');

// Testing as a admin user
$I->am('a Phphub admin');
$I->signInAsAdmin();

$I->amOnRoute('topics.show', $topic->id);
$I->seeElement('#reply-delete-' . $reply->id);
$I->click('#reply-delete-' . $reply->id);

$I->dontSeeRecord('replies', [
    'id' => $reply->id
]);

