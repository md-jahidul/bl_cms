<?php

namespace App\Models\HealthHubNewJourney;

use Illuminate\Database\Eloquent\Model;

class HealthHubPackage extends Model
{
    protected $fillable = ['package_id', 'title_en', 'title_bn', 'logo', 'callback_url', 'allowed_customer',
                            'subscription_url', 'health_hub_partner_id', 'details_en', 'details_bn', 'health_hub_plan_id', 'status'];

    public function partner(){
        return $this->belongsTo(HealthHubPartner::class, 'health_hub_partner_id', 'id');
    }

    public function plan(){
        return $this->belongsTo(HealthHubPlan::class, 'health_hub_plan_id', 'id');
    }
}
