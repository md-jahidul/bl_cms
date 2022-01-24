<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsLanguage extends Model
{
    protected $fillable = [
        'feature',
        'default_lang',
        'sms_en',
        'sms_bn',
        'concat_char',
        'status',
        'updated_by'
    ];
}
