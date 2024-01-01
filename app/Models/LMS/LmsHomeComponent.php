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
        'android_version_code_min',
        'android_version_code_max',
        'ios_version_code_min',
        'ios_version_code_max',
        'other_component_id',
        'cta_name_en',
        'cta_name_bn',
        'deeplink',
        'icon',
    ];
}
