<?php

namespace App\Models\EventBasedBonusCampaign;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventBasedCampaign extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'description_bn',
        'campaign_user_type',
        'base_msisdn_id',
        'icon_image',
        'reward_product_code_prepaid',
        'reward_product_code_postpaid',
        'start_date',
        'end_date',
        'status',
        'created_by',
    ];

}