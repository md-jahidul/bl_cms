<?php

namespace App\Models\NewCampaignModality;

use Illuminate\Database\Eloquent\Model;

class MyBlCampaignSection extends Model
{
    protected $fillable = ['id', 'title_en', 'title_bn', 'campaign_type', 'slug', 'display_order', 'status'];
}
