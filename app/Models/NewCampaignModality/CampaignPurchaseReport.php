<?php

namespace App\Models\NewCampaignModality;

use Illuminate\Database\Eloquent\Model;

class CampaignPurchaseReport extends Model
{
    protected $fillable = ['product_code', 'campaign_type', 'campaign_id'];

    public function msisdnReports()
    {
        return $this->hasMany(CampaignPurchaseMsisdnReport::class, 'purchase_report_id', 'id');
    }
}
