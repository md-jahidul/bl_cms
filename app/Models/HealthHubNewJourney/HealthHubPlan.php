<?php

namespace App\Models\HealthHubNewJourney;

use Illuminate\Database\Eloquent\Model;

class HealthHubPlan extends Model
{
    protected $fillable = ['title_en', 'title_bn', 'logo', 'slug', 'status', 'health_hub_dashboard_id'];

    public function packages(){
        return $this->hasMany(HealthHubPackage::class, 'health_hub_plan_id', 'id');
    }
}
