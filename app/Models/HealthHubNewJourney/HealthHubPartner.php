<?php

namespace App\Models\HealthHubNewJourney;

use Illuminate\Database\Eloquent\Model;

class HealthHubPartner extends Model
{
    protected $fillable = [
        'partner_id',
        'name_en',
        'name_bn',
        'logo',
        'status',
        'access_key'
    ];

    public function packages(){
        return $this->hasMany(HealthHubPackage::class, 'health_hub_partner_id', 'id');
    }
}
