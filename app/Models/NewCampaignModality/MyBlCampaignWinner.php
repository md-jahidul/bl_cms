<?php

namespace App\Models\NewCampaignModality;

use Illuminate\Database\Eloquent\Model;

class MyBlCampaignWinner extends Model
{
    protected $guarded = [];
    protected $table = 'my_bl_campaign_winners';
    protected $appends = ['winning_slot', 'campaign_id_winning_slot', 'campaign_id_msisdn_product_code_winning_slot'];
    protected $dates = ['winning_slot_start', 'winning_slot_end'];

    public function campaign() 
    {
        return $this->belongsTo(MyBlCampaign::class, 'my_bl_campaign_id', 'id');
    }

    public function getWinningSlotAttribute(): string
    {
        return $this->winning_slot_start . ',' . $this->winning_slot_end;
    }

    public function getCampaignIdWinningSlotAttribute(): string
    {
        return $this->campaign->id . ',' . $this->getWinningSlotAttribute();
    }

    public function getCampaignIdMsisdnProductCodeWinningSlotAttribute(): string
    {
        return $this->campaign->id . ',' . $this->msisdn . ',' . $this->product_code . ',' . $this->getWinningSlotAttribute();
    }

}
