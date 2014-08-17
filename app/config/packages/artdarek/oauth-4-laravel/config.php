<?php 

return [
	
	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session', 

	/**
	 * Consumers
	 */
	'consumers' => [
        'GitHub' => [
            'client_id'     => getenv('client_id'),
            'client_secret' => getenv('client_secret'),
            'scope'         => ['user'],
        ],
    ],

];