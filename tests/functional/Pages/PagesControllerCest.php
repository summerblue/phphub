<?php

/**
 * ------------------------------------
 *          Pages visible test
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
        $I->amOnRoute('home');
        $I->seeElement('body');
    }

    public function about(FunctionalTester $I)
    {
        $I->am('a guest');
        $I->wantTo('Visit about page.');
        $I->amOnRoute('about');
        $I->seeElement('body');
    }

    public function wiki(FunctionalTester $I)
    {

    }

    public function search(FunctionalTester $I)
    {

    }

    public function feed(FunctionalTester $I)
    {

    }
}
