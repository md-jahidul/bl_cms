<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MyblHealthHub extends Model
{
    protected $guarded = [];

    protected $casts = [
        'other_info' => 'array'
    ];

    public function healthHubAnalytics(): HasMany
    {
        return $this->hasMany(MyblHealthHubAnalytic::class, 'health_hub_id', 'id');
    }
}
