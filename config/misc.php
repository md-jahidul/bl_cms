<?php

return [
    'migrator' => [
        'product_list' => env('PRODUCT_LIST_VERSION', 'V2'),
        'config' => env('CONFIG_VERSION', 'V2'),
        'dxp_new_login' => env('DXP_NEW_LOGIN', true),
    ],
];
