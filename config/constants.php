<?php

return [
    'referee_status' => [
        'invited' => 'invited',
        'redeemed' => 'redeemed',
        'claimed' => 'claimed',
    ],

    'redis-keys' => [
        'available_products' => 'available_products'
    ],

    'status_bootstrap_classes' => [
        'active' => 'success',
        'inactive' => 'danger',
        'completed' => 'info'
    ],
    'cs_selfcare' => [
        'expired_after' => null,
        'code_length' => 10,
        'referral_code_prefix' => 'CS',
        'log_type' => 'CS_REFERRAL',
        'cs_referral_product_code_prepaid' => env('CS_REFERRAL_PRODUCT_CODE_PREPAID'),
        'cs_referral_product_code_postpaid' => env('CS_REFERRAL_PRODUCT_CODE_POSTPAID'),
        'rafm_report_mail' => env('CS_SELFCARE_RAFM_REPORT_MAIL')
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
