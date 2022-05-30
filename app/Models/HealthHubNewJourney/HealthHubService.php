<?php

namespace App\Models\HealthHubNewJourney;

use Illuminate\Database\Eloquent\Model;

class HealthHubService extends Model
{
    protected $fillable = [
        'title_en',
        'title_bn',
        'logo',
        'details_en',
        'details_bn',
        'status',
        'health_hub_dashboard_id'
    ];
}
