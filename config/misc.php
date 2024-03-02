<?php

return [
    'migrator' => [
        'dxp' => [
            'fe_base_url' => env("DXP_FE_BASE_URL", "http://172.16.191.50:8445"),
            'api_base_url' => env("DXP_API_BASE_URL", "http://172.16.191.50:9443"),
        ],
        'product_list' => env('PRODUCT_LIST_VERSION', 'V2'),
        'config' => env('CONFIG_VERSION', 'V2'),
        'dxp_new_login' => env('DXP_NEW_LOGIN', true),
    ],
];
