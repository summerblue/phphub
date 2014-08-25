<?php

/**
 * ------------------------------------
 *          Notify user being "@"
 * ------------------------------------
 */

$I = new FunctionalTester($scenario);

Route::enableFilters();

$I->wantTo('Notify a User when he/she is being AT on a newly Reply');

$SuperMan = $I->have('User', ['name' => 'SuperMan']);

$user = $I->signIn();
$topic = $I->postATopic(['title' => 'My Awsome Topic.', 'user_id' => $user->id]);

// another user leave a reply
$randomUser = $I->signIn();
$I->amOnRoute('topics.show', $topic->id );
$I->fillField(['name' => 'body'], 'The Awsome Reply. @SuperMan');
$I->click('#reply-create-submit');
$I->see('The Awsome Reply. [@SuperMan](' .route('users.show', $SuperMan->id).')');

// sign in the author
$user = $I->signIn($SuperMan);

$I->seeRecord('users', [
    'id' => $user->id,
    'notification_count' => 1
]);

$I->amOnRoute('notifications.index');
$I->see('My Awsome Topic.');
$I->see('The Awsome Reply. [@SuperMan](' .route('users.show', $SuperMan->id).')');
$I->see($randomUser->name);

$I->seeRecord('users', [
    'id' => $user->id,
    'notification_count' => 0
]);
