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
            'client_id'     => 'eefd4111fbcb0e1d0fb9',
            'client_secret' => '3dce7078f20bc10a1f6bef559b81787648f1b372',
            'scope'         => ['user'],
        ],
    ],

];