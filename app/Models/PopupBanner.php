<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PopupBanner extends Model
{
    //

    protected $fillable = [
        'banner',
        'deeplink',
        'status',
        'is_priority',
        'android_version_code_min',
        'android_version_code_max',
        'ios_version_code_min',
        'ios_version_code_max',
        'start_date',
        'end_date'
    ];
}
