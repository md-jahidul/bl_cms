<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GenericRailItem extends Model
{
    protected $fillable = [
        'generic_rail_id',
        'title_en',
        'title_bn',
        'icon',
        'status',
        'is_highlight',
        'deeplink',
        'display_order',
        'android_version_code_min',
        'android_version_code_max',
        'ios_version_code_min',
        'ios_version_code_max',
        'user_type'
    ];
}
