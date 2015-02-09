<?php

use Phphub\Exceptions\ManageTopicsException;

class BaseController extends Controller {

    public function __construct()
    {
        // for clockwork debuger
        $this->beforeFilter(function()
		{
		    Event::fire('clockwork.controller.start');
		});
		$this->afterFilter(function()
		{
		    Event::fire('clockwork.controller.end');
		});

        // csrf check for every post request
        $this->beforeFilter('csrf', ['on' => 'post']);

        // Check if a user is banned.
        $this->beforeFilter('check_banned_user', ['except' => ['userBanned', 'logout']]);
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
		if (! Entrust::can('manage_topics') && $author_id != Auth::id())
		{
			throw new ManageTopicsException("permission-required");
		}
	}

}
