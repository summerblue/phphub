<?php

class VotesController extends \BaseController {

	/**
	 * Show the form for creating a new vote
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('votes.create');
	}

}
