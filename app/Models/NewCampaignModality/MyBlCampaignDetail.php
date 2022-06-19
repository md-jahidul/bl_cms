<?php

namespace App\Models\NewCampaignModality;

use Illuminate\Database\Eloquent\Model;

class MyBlCampaignDetail extends Model
{
    protected $fillable =
        [
            'my_bl_campaign_id',
            'recharge_amount',
            'cash_back_amount',
            'banner_image',
            'thumb_image',
            'cash_back_type',
            'purchase_eligibility',
            'product_code',
            'desc_en',
            'desc_bn',
            'show_in_home',
            'show_product_as',
            'start_date',
            'end_date',
            'status'
        ];
}
