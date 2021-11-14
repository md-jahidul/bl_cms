<?php

return [
    'referee_status' => [
        'invited' => 'invited',
        'redeemed' => 'redeemed',
        'claimed' => 'claimed',
    ],

    'test_msisdn_removal' => [
        'msisdns' => ['01409900110', '01409900160'],

        'features' => [
            'customer' => [
                'title' => 'Customers',
                'model' => 'customer',
                'key' => 'msisdn',
            ],
            'referAndEarn' => [
                [
                    'title' => 'Refer And Earn',
                    'model' => 'referee',
                    'key' => 'referee_msisdn',
                ],
                [
                    'title' => 'Refer And Earn',
                    'model' => 'referrer',
                    'key' => 'msisdn',
                ]
            ]
        ]
    ]
];
