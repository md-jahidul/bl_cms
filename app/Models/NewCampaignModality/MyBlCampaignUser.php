<?php

namespace App\Models\NewCampaignModality;

use Illuminate\Database\Eloquent\Model;

class MyBlCampaignUser extends Model
{
    protected $table = 'my_bl_campaign_users';
    protected $guarded = [];

    public function campaign() 
    {
        return $this->belongsTo(MyBlCampaign::class, 'my_bl_campaign_id', 'id');
    }
}
