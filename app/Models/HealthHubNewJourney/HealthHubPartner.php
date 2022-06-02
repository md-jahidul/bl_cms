<?php

namespace App\Models\HealthHubNewJourney;

use Illuminate\Database\Eloquent\Model;

class HealthHubPartner extends Model
{
    protected $fillable = [
        'name_en',
        'name_bn',
        'logo',
        'status', 
        'access_key'
    ];
}
