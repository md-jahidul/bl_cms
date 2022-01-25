<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyblHealthHub extends Model
{
    protected $guarded = [];

    protected $casts = [
        'other_info' => 'array'
    ];
}
