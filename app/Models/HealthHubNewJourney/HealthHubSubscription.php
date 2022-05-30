<?php

namespace App\Models\HealthHubNewJourney;

use Illuminate\Database\Eloquent\Model;

class HealthHubSubscription extends Model
{
    protected $guarded = ['id'];

    public function package(){
        return $this->belongsTo(HealthHubPackage::class, 'health_hub_parckage_id', 'id');
    }
}
