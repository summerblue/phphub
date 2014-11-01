<?php

return [
    'local' => [
        'type' => 'Local',
        'root' => getenv('BACK_MANAGER_ROOT'),
    ],
    'dropbox' => [
        'type' => 'Dropbox',
        'token' => getenv('BACK_MANAGER_DROPBOX_token'),
        'key' => getenv('BACK_MANAGER_DROPBOX_key'),
        'secret' => getenv('BACK_MANAGER_DROPBOX_secret'),
        'app' => getenv('BACK_MANAGER_DROPBOX_app'),
        'root' => getenv('BACK_MANAGER_DROPBOX_root'),
    ],
];
