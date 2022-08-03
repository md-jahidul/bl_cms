<?php

return [
    'referee_status' => [
        'invited' => 'invited',
        'redeemed' => 'redeemed',
        'claimed' => 'claimed',
    ],
    'cs_selfcare' => [
        'expired_after' => \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::createFromFormat('d/m/Y',
            env('CS_REFERRAL_END_DATE', '01/01/2022'))),
        'code_length' => 10,
        'referral_code_prefix' => 'CS',
        'log_type' => 'CS_REFERRAL',
        'cs_referral_product_code_prepaid' => env('CS_REFERRAL_PRODUCT_CODE_PREPAID'),
        'cs_referral_product_code_postpaid' => env('CS_REFERRAL_PRODUCT_CODE_POSTPAID'),
        'rafm_report_mail' => env('CS_SELFCARE_RAFM_REPORT_MAIL'),
        'cs_report_send_at' => env('CS_REPORT_SEND_AT', '02:00')
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
