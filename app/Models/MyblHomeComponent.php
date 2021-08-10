<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyblHomeComponent extends Model
{
    protected $fillable = [
        'title_en',
        'title_bn',
        'is_api_call_enable',
        'display_order',
        'is_eligible'
    ];
}
