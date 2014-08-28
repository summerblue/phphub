<?php

/**
 * ------------------------------------
 * 			Topic Listing
 * ------------------------------------
 */

$I = new FunctionalTester($scenario);
$I->am('a Phphub member');
$I->wantTo('List all topics which are created for PHPHUB');

$I->postATopic(['title' => 'Foo']);
$I->postATopic(['title' => 'Bar']);

$I->amOnRoute('topics.index');

$I->see('Foo');
$I->see('Bar');
