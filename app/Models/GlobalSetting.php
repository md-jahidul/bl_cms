<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalSetting extends Model
{
    protected $table = 'global_settings'; // Specify the table name if it's different from the model name.

    protected $fillable = [
        'settings_key',
        'settings_value',
        'value_type',
        'android_min',
        'android_max',
        'ios_min',
        'ios_max',
        'updated_by',
        'created_at',
        'updated_at',
        'status'
    ];
}
