<?php

/**
 * ------------------------------------
 *          Notify newly reply
 * ------------------------------------
 */

$I = new FunctionalTester($scenario);

Route::enableFilters();

$I->wantTo('Notify The Author when his/her Topic has a new Reply');

$user = $I->have('User', ['name' => 'SuperMan']);
$topic = $I->postATopic(['title' => 'My Awsome Topic.', 'user_id' => $user->id]);

// another user leave a reply
$randomUser = $I->signIn();
$I->amOnRoute('topics.show', $topic->id );
$I->fillField(['name' => 'body'], 'The Awsome Reply.');
$I->click('#reply-create-submit');
$I->see('The Awsome Reply.');

// sign in the author
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
