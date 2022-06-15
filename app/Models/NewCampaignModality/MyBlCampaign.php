<?php

namespace App\Models\NewCampaignModality;

use Illuminate\Database\Eloquent\Model;

class MyBlCampaign extends Model
{
    protected $fillable =
        [
            'mybl_campaign_section_id',
            'base_groups_id',
            'exclude_base_groups_id',
            'first_sign_up_user',
            'user_group_type',
            'name',
            'type',
            'winning_type',
            'winning_interval',
            'winning_interval_unit',
            'reward_bonus_code',
            "winning_massage_en",
            "winning_massage_bn",
            'deno_type',
            'recurring_type',
            'reward_getting_type',
            'number_of_apply_times',
            'max_amount',
            'purchase_eligibility',
            'payment_gateways',
            'payment_channels',
            'start_date',
            'end_date',
            'status',
        ];
}
