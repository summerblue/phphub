<?php

class UsersController extends \BaseController {

	public function index()
	{
		$users = User::all();
		return View::make('users.index', compact('users'));
	}

	public function create()
	{
		//
	}

	public function store()
	{
		//
	}

	public function show($id)
	{
		$user = User::findOrFail($id);
		$topics = Topic::userRecentTopics($user->id);
		$replies = Reply::userRecentReplies($user->id);
		return View::make('users.show', compact('user', 'topics', 'replies'));
	}

	public function edit($id)
	{
		//
	}

	public function update($id)
	{
		//
	}

	public function destroy($id)
	{
		//
	}

	public function replies($id)
	{
		$user = User::findOrFail($id);
		$replies = Reply::userRepliesWithPagination($user->id);
		return View::make('users.replies', compact('user', 'replies'));
	}

	public function topics($id)
	{
		$user = User::findOrFail($id);
		$topics = Topic::userTopicsWithPagination($user->id);
		return View::make('users.topics', compact('user', 'topics'));
	}

	public function favorites($id)
	{
		
	}
}