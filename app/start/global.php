<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/

$logFile = php_sapi_name().'.log';
Log::useDailyFiles(storage_path().'/logs/'.$logFile);


/*
|--------------------------------------------------------------------------
| Bugsnag
|--------------------------------------------------------------------------
*/
// Bugsnag::setReleaseStage("production");
Bugsnag::setErrorReportingLevel(E_ALL & ~E_NOTICE);
Bugsnag::setBeforeNotifyFunction(function($error) {
    // Do any custom error handling here

    // Also add some meta data to each error
    if (Auth::check()) {
        $user = Auth::user()->toArray();
        $error->setMetaData(array(
            "user" => $user
        ));
    }
});

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
    $pathInfo = Request::getPathInfo();
    $message = $exception->getMessage() ?: 'Exception';
    Log::error("$code - $message @ $pathInfo\r\n$exception");

    if (Config::get('app.debug')) {
        return;
    }

    Bugsnag::notifyException($exception);

    switch ($code)
    {
        case 403:
            return Response::view('errors/403', [], 403);

        case 500:
            return Response::view('errors/500', [], 500);

        default:
            return Response::view('errors/404', [], $code);
    }
});

/*
 * General Form Validation error handling.
 */
App::error(function(Laracasts\Validation\FormValidationException $exception, $code)
{
    return Redirect::back()->withInput()->withErrors($exception->getErrors());
});

/**
 *  Manage Topics Permission error handling.
 */
App::error(function(Phphub\Exceptions\ManageTopicsException $exception, $code)
{
    return Redirect::route('admin-required');
});

/**
 *  Model not found
 */
App::error(function(Illuminate\Database\Eloquent\ModelNotFoundException $e)
{
    if (Config::get('app.debug'))
        return;

    return Response::view('errors/404', [], 404);
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

Event::listen('turbo.pjax', function($request, $response)
{
    $response->header('X-PJAX-URL', Request::getUri());
});

require app_path().'/filters.php';

