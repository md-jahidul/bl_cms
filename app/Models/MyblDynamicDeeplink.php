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
}
