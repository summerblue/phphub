<?php

/**
 * ------------------------------------
 * 			话题列表功能测试
 * ------------------------------------
 */

$I = new FunctionalTester($scenario);
$I->am('a Phphub member');
$I->wantTo('List all topics which are created for PHPHUB');

$I->postATopic(['title' => 'Foo']);
$I->postATopic(['title' => 'Bar']);

$I->amOnPage('/topics');

$I->see('Foo');
$I->see('Bar');