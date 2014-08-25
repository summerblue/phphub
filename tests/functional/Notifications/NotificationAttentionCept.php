<?php

/**
 * ------------------------------------
 *          Notify attented user
 * ------------------------------------
 */

$I = new FunctionalTester($scenario);

Route::enableFilters();

$I->wantTo('Notify A User when he/she attented a Topic');
$topic = $I->postATopic(['title' => 'My Awsome Topic.']);

// attented a topic
$user = $I->signIn();
$I->amOnRoute('topics.show', $topic->id );
$I->click('#topic-attent-button');

// another user leave a reply
$randomUser = $I->signIn();
$I->amOnRoute('topics.show', $topic->id );
$I->fillField(['name' => 'body'], 'The Awsome Reply.');
$I->click('#reply-create-submit');
$I->see('The Awsome Reply.');

// the first user sign in again
$user = $I->signIn($user);

$I->seeRecord('users', [
    'id' => $user->id,
    'notification_count' => 1
]);

$I->amOnRoute('notifications.index');
$I->see('My Awsome Topic.');
$I->see('The Awsome Reply.');
$I->see($randomUser->name);

$I->seeRecord('users', [
    'id' => $user->id,
    'notification_count' => 0
]);
