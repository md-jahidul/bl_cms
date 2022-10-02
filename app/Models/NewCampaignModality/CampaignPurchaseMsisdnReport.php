<?php

namespace App\Models\NewCampaignModality;

use Illuminate\Database\Eloquent\Model;

class CampaignPurchaseMsisdnReport extends Model
{
    protected $fillable = ['purchase_report_id', 'msisdn', 'action_type', 'failed_reason'];
}
