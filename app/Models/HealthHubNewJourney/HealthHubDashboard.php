<?php

namespace App\Models\HealthHubNewJourney;

use Illuminate\Database\Eloquent\Model;

class HealthHubDashboard extends Model
{
    protected $fillable = [
        'title_en',
        'title_bn',
        'home_banner',
        'landing_page_banner'
    ];
}
