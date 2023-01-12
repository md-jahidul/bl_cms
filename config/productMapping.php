<?php

return [
    'mybl' => [
        'columns' => [
            'sim_type'              => 0,
            'content_type'          => 1,
            'product_code'          => 2,
            'renew_product_code'    => 3,
            'recharge_product_code' => 4,
            'name'                  => 5,
            'commercial_name_en'    => 6,
            'commercial_name_bn'    => 7,
            'short_description'     => 8,
            'activation_ussd'       => 9,
            'balance_check_ussd'    => 10,
            'sms_volume'            => 11,
            'minute_volume'         => 12,
            'data_volume'           => 13,
            'internet_volume_mb'    => 13,
            'data_volume_unit'      => 14,
            'validity'              => 15,
            'validity_unit'         => 16,
            'mrp_price'             => 17,
            'price'                 => 18,
            'vat'                   => 19,
            'show_recharge_offer'   => 20,
            'is_rate_cutter_offer'  => 21,
            'offer_section_title'   => 22,
            'tag'                   => 23,
            'call_rate'             => 24,
            'call_rate_unit'        => 25,
            'display_sd_vat_tax'    => 26,
            'display_title_en'      => 27,
            'display_title_bn'      => 28,
            'points'                => 29,
            'is_visible'            => 30,
            'show_from'             => 31,
            'hide_from'             => 32,
            'status'                => 33,
        ],
        'product_schedule_statuses' => [
            0 => 'None',
            1 => 'Active Schedule',
            2 => 'To be Hidden',
            3 => 'Completed Schedule',
            4 => 'To be Shown'

        ],
        'max_no_of_pin_to_top' => 150
    ],
    /*'pcat' => [
        'columns' => [
            'content_type'          => 10,
            'product_code'          => 4,
            'name'                  => 1,
            'commercial_name_en'    => 2,
            'commercial_name_bn'    => 3,
            'activation_ussd'       =>
            'balance_check_ussd'    =>
            'sms_volume'            =>
            'minute_volume'         =>
            'data_volume'           =>
            'internet_volume_mb'    =>
            'data_volume_unit'      =>
            'validity'              =>
            'validity_unit'         =>
            'mrp_price'             =>
            'price'                 =>
            'vat'                   =>
            'show_recharge_offer'   =>
            'is_rate_cutter_offer'  =>
            'offer_section_title'   =>
            'tag'                   =>
            'call_rate'             =>
            'call_rate_unit'        =>
            'status'                =>
            'validity_in_days'      =>
        ]
    ],*/
    'assetlite' => [
        'columns' => [
            'sim_type'             => 0,
            'content_type'         => 1,
            'product_code'         => 2,
            'recharge_product_code'=> 3,
            'renew_product_code'   => 4,
            'commercial_name_en'   => 5,
            'commercial_name_bn'   => 6,
            'activation_ussd'      => 7,
            'balance_check_ussd'   => 8,
            'mrp_price'            => 9,
            'price'                => 10,
            'vat'                  => 11,
            'validity'             => 12,
            'validity_unit'        => 13,
            'data_volume_unit'     => 14,
            'data_volume'          => 15,
            'internet_volume_mb'   => 16,
            'sms_volume'           => 17,
            'call_rate'            => 18,
            'call_rate_unit'       => 19,

            'minute_volume'        => 20,
            'validity_in_days'     => 21,
            'special_product'      => 22,#p
            'rate_cutter_offer'    => 23,#p
            'is_four_g_offer'      => 24,#p
            'sd_vat_tax_en'        => 25,
            'sd_vat_tax_bn'        => 26,
            'show_in_home'         => 27,
            'short_description'    => 28,
            'tag'                  => 29,
            'family_group'         => 30,

            'name'                 => 31,
            'url_slug'             => 32,#p
            'url_slug_bn'          => 33,#p
            'start_date'           => 34,#p
            'end_date'             => 35,#p

            // 'assetlite_offer_type' => 23,
            // 'is_gift_offer'        => 25,
            // 'is_recharge_offer'    => 24,
            // 'is_auto_renewable'    => 23,
            // 'is_amar_offer'        => 22,
            // 'offer_id'             => 12,
            // 'family_name'          => 2,
            // 'status'     => 31,
            ]
    ]
];
