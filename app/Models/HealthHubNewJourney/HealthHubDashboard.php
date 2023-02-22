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

    public function services(){
        return $this->hasMany(HealthHubService::class, 'health_hub_dashboard_id', 'id');
    }

    public function plans(){
        return $this->hasMany(HealthHubPlan::class, 'health_hub_dashboard_id', 'id');
    }
}
