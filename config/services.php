<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\Models\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],

    'firebase' => [
        'database_url' => env('FIREBASE_DATABASE_URL', ''),
        'project_id' => env('FIREBASE_PROJECT_ID', ''),
        'private_key_id' => env('FIREBASE_PRIVATE_KEY_ID', 'your-key'),
        // replacement needed to get a multiline private key from .env
        'private_key' => str_replace("\\n", "\n", '-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQC02dMJ1fY/UTsJ\nBzJJNxkErWxfLm3Bpm8i3MFFjminQqPNdcEXiGKOU5M1FsNRCjCOMox6VNNJwJhm\ncnJCn/rSyBg1kbAFuQTYLBdIHvUawgVml0RcJ93AhMlQPe0Le0cv58Fkd8dwnjK0\ndhzRH3+F99rEgkHefQc1t060NQu4Sl0S4/aO+9DcDhWZiUl05flPG5zmpxyjIStB\nb6xl4obun8fyjoqUyT2PEZQBjBgYtvJ1fpitMlkPP+plU3cDw4F5Jtu9TyF0DtQV\nUCkx8lsMo+iLbvEoaK3aj2AZwJPQbQO82moFdRf4KfOJ0XpUyMKTyobF4Lr/EpLk\nekBAagwFAgMBAAECggEAC3O3r2nDHCNSr7Gq94Prq6YntKdF//tAEl8URglMizrn\nEH2iapESXJziN3xnhdw1UuvUhXKVppfxjps0rQ9gXLSbA9lj4hjjO6UfHEwJjVY3\n7VUq2QMVQbmm3dPuDMoTqe7tCiWjlXgPEepgzMVH1/3n9oWhEiuspzQiYbryMQs5\nErgbgfe+6i6dPdln93I+MsOKxep/uelXUd3+BKdGMXuogkPE2zB2R3pYawJTV0qd\nP8g39TuPgeJSqeXX7mNzeOxHTdGTArPQAddpj0afqHXniYQCeBBMC4aw+28e5ot0\nn4hW4O2PL5CDS27pYD4qZFFUUH3N31fdtTCTkAtEAQKBgQDtuGGTQ2rwFz7pjXw7\nOgtYLnTP/hCZyRqozL2FHRX4ePlcY4pubFG1/1gY3SAvGeWuJODTav4+fQAVysm2\n0oMsf3HH38XTqc/PhevPr51KVtp5sXEXxeVuflTB3FNsp9kejHVc8BEql53WCdOU\nP0ICr/YkiaIgxrYX0MMR68EUhQKBgQDCwfJloneIMOnbNXbr4SYIVDzZ5WzVPWYM\nUBivFCmHIkI9yrYxMiHRV6yoFw0jQFTffotH0lVedgHc+rz2F6Cx+diYXM25mfTT\nmilKakNdgUG46VFfu+lFSwjeBCy7OjK6cNwUxyT/7+0IpzY7BGfd9pl+3nkusOnN\nTVA9ttBxgQKBgQDUCRo/mGrSLGnZOHIPAf8McKOQwjVcdpxo4/ZHvWHTd1Q0rDTV\nuZhIlbGmu9XxLVBIvGwtJ8oPQr/IsFCr2alXD3YVqetymIzbtcBYR3Qs0rucwED3\ny3SR0e0X3cYrrKtlLDOi6h7ltsb6G1m1aZcffoQ2ou0R/yx8oaDdY0OdYQKBgHeB\n+ZMiMcURdr77vMCbhPIBduGiZbkoFvGhSLROY/k3LXyrYkcn4xaJfTocAwTJmgsW\npLLqv1XaheQqvD8qWoI7tQwxjk/AyDn8VDAEqte61DB6g2OCdG7/zy4lU6mD2dMM\nJBBf7zVZ7ZKswJtQZcgPZTszmxrqll1TftSP1LKBAoGAZQIGIAKBjFz+q39JuGB5\nDuTEJsce64e3VF7e88yovZ0bCL0VkbL3Cj9IqfOMBX1+lKwabMY2vcx2DjwNzqXC\nXm7ULP3/jcS84d58RinXPRf6yxVDnFoBh3H7lEQ/4RB95WwHJ4erLnEYzFfjjTHN\nlZBkkqXo1nkL7HiLqd0owXc=\n-----END PRIVATE KEY-----\n'),
        'client_email' => env('FIREBASE_CLIENT_EMAIL', 'e@email.com'),
        'client_id' => env('FIREBASE_CLIENT_ID', ''),
        'client_x509_cert_url' => env('FIREBASE_CLIENT_x509_CERT_URL', ''),
    ]
];
