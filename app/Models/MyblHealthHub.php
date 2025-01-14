<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MyblHealthHub extends Model
{
    use LogModelAction;
    protected $guarded = [];

    protected $casts = [
        'other_info' => 'array'
    ];

    public function healthHubAnalytics(): HasMany
    {
        return $this->hasMany(MyblHealthHubAnalytic::class, 'health_hub_id', 'id');
    }

    public function healthHubAnalyticsDetails(): HasMany
    {
        return $this->hasMany(HealthHubAnalyticDetails::class, 'health_hub_id', 'id');
    }
}
