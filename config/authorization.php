<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Authorization Configuration
    |--------------------------------------------------------------------------
    */
    'route-prefix' => 'authorize',
    'user-model' => 'App\Models\User',
    'middleware' => 'authorize'
];
