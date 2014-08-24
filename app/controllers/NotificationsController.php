<?php

class NotificationsController extends \BaseController {

	/**
	 * Display a listing of notifications
	 *
	 * @return Response
	 */
	public function index()
	{
		$notifications = Auth::user()->notifications();

		Auth::user()->notification_count = 0;
		Auth::user()->save();

		return View::make('notifications.index', compact('notifications'));
	}

	/**
	 * Remove the specified notification from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Notification::destroy($id);

		return Redirect::route('notifications.index');
	}

}
