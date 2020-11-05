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
            'status'                => 27,

        ]
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
//            'family_name'          => 2,
            'product_code'         => 2,
            'recharge_product_code' => 3,
            'renew_product_code'   => 4,
            'name'                 => 5,
            'commercial_name_en'   => 6,
            'commercial_name_bn'   => 7,
            'short_description'    => 8,
            'activation_ussd'      => 9,
            'balance_check_ussd'   => 10,
//            'offer_id'             => 12,
            'sms_volume'           => 11,
            'minute_volume'        => 12,
            'data_volume'          => 13,
            'internet_volume_mb'   => 13,
            'data_volume_unit'     => 14,
            'validity'             => 15,
            'validity_in_days'     => 15,
            'validity_unit'        => 16,
            'mrp_price'            => 17,
            'price'                => 18,
            'vat'                  => 19,
            'is_amar_offer'        => 20,
//            'is_auto_renewable'    => 23,
//            'is_recharge_offer'    => 24,
//            'is_gift_offer'        => 25,
            'rate_cutter_offer'    => 21,
            'rate_cutter_unit'     => 22,
            'assetlite_offer_type' => 23,
            'short_text'           => 24,
            'sms_rate_unit'        => 25,
//            'validity_in_days'     => 31,
        ]
    ]
];
