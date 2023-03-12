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
        'expired_after' => \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::createFromFormat('d/m/Y H:i:s',
            env('CS_REFERRAL_END_DATE', '01/01/2022'))),
        'code_length' => 10,
        'referral_code_prefix' => 'CS',
        'log_type' => 'CS_REFERRAL',
        'cs_referral_product_code_prepaid' => env('CS_REFERRAL_PRODUCT_CODE_PREPAID'),
        'cs_referral_product_code_postpaid' => env('CS_REFERRAL_PRODUCT_CODE_POSTPAID'),
        'rafm_report_mail' => env('CS_SELFCARE_RAFM_REPORT_MAIL'),
        'cs_report_send_at' => env('CS_REPORT_SEND_AT', '02:00')
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
    ],

    'sms' => [
        'langs' => [
            'bn' => 'Bengali',
            'en' => 'English'
        ],
        'features' => [
            'send-otp' => 'Send OTP',
            'refer-and-earn' => 'Refer And Earn Invite'
        ],
        'platforms' => [
            'mybl' => 'MyBL App',
            'assetlite' => 'Assetlite Website',
        ]
    ],

    'validityUnits' => ['hours', 'days'],

    'partnerChannelName' => ['bKash', 'Nagad', 'EBL'],
    
    'terms_conditions_feature_names' => [
        'general' => 'General',
        'balance_transfer' => 'Balance Transfer'
    ],

    'capping_interval' => [
        0 => 'daily',
        6 => 'weekly',
        29 => 'monthly',
        364 => 'yearly'
    ]
];
