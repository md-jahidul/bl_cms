<?php

namespace App\Models\LMS;

use Illuminate\Database\Eloquent\Model;

class LmsShortcut extends Model
{
    protected $fillable = [
        'title_en',
        'title_bn',
        'icon',
        'component_identifier',
        'customer_type',
        'display_order',
        'deeplink_url',
        'status',
        'android_version_code_min',
        'android_version_code_max',
        'ios_version_code_min',
        'ios_version_code_max',
    ];
}
