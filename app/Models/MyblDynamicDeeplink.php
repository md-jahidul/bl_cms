<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyblDynamicDeeplink extends Model
{
    protected $guarded = [];

    public function referenceable()
    {
        return $this->morphTo();
    }

    public function deeplinkMsisdnHitCounts()
    {
        return $this->hasMany(MyblDeeplinkMsisdnCount::class, 'dynamic_deeplink_id', 'id');
    }
}
