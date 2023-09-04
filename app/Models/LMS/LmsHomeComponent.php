<?php

namespace App\Models\LMS;

use Illuminate\Database\Eloquent\Model;

class LmsHomeComponent extends Model
{
    protected $fillable = [
        'component_key',
        'title_en',
        'title_bn',
        'display_order',
        'is_api_call_enable',
        'is_eligible',
        'version_code'
    ];
}
