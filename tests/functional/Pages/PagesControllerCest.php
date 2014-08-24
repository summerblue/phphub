<?php

/**
 * ------------------------------------
 *          页面可用性测试
 * ------------------------------------
 */

use \FunctionalTester;

class PagesControllerCest
{
    public function _before()
    {
    }

    public function _after()
    {
    }

    public function home(FunctionalTester $I)
    {
        $I->am('a guest');
        $I->wantTo('Visit home page.');
        $I->amOnPage('/');
        $I->seeElement('body');

    }

    public function about(FunctionalTester $I)
    {
        $I->am('a guest');
        $I->wantTo('Visit about page.');
        $I->amOnPage('/about');
        $I->seeElement('body');
    }
}