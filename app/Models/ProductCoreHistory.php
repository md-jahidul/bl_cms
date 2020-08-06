<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCoreHistory extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_core_id',
        'created_by',
        'product_code',
        'recharge_product_code',
        'renew_product_code',
        'name',
        'commercial_name_en',
        'commercial_name_bn',
        'short_description',
        'sim_type',
        'content_type',
        'family_name',
        'activation_ussd',
        'balance_check_ussd',
        'mrp_price',
        'price',
        'vat',
        'validity',
        'validity_unit',
        'data_volume',
        'data_volume_unit',
        'validity_in_days',
        'internet_volume_mb',
        'sms_volume',
        'minute_volume',
        'call_rate',
        'call_rate_unit',
        'sms_rate',
        'is_auto_renewable',
        'is_recharge_offer',
        'is_gift_offer',
        'show_in_app',
        'offer_id',
        'other_info',
        'platform',
        'status'
    ];


}
