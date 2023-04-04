<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NonBlOffer extends Model
{
    protected $fillable = [
        'component_key',
        'title_en',
        'title_bn',
        'is_api_call_enable',
        'display_order',
        'is_eligible'
    ];
}
