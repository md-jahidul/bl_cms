<?php


return [

    'name' => [
        'audio-book',
    ],

    'audio-book' => [
        'base_uri' => env('AUDIOBOOK_BASE_URL', 'https://api.kabbik.com/'),
        'platform_fe_base_uri' => env('AUDIOBOOK_FE_BASE_URL', 'https://mybl.kabbik.com/'),
        'client_id' => env('AUDIOBOOK_CLIENT_ID'),
        'client_secret' => env('AUDIOBOOK_CLIENT_SECRET')
    ],
];

