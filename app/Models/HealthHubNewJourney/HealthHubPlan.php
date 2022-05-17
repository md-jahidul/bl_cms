<?php

namespace App\Models\HealthHubNewJourney;

use Illuminate\Database\Eloquent\Model;

class HealthHubPlan extends Model
{
    protected $fillable = ['title_en', 'title_bn', 'logo', 'slug', 'status'];
}
