<?php

use Phphub\Exceptions\ManageTopicsException;

class BaseController extends Controller {


    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));

        // for clockwork debuger
        $this->beforeFilter(function()
		{
		    Event::fire('clockwork.controller.start');
		});
		$this->afterFilter(function()
		{
		    Event::fire('clockwork.controller.end');
		});
    }

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}

		View::share('currentUser', Auth::user());
		View::share('siteStat', App::make('Phphub\Stat\Stat')->getSiteStat());
		View::share('siteTip', Tip::getRandTip());
	}

	public function authorOrAdminPermissioinRequire($author_id)
	{
		if (! Entrust::can('manage_topics') && $author_id != Auth::user()->id)
		{
			throw new ManageTopicsException("permission-required");
		}
	}

}
