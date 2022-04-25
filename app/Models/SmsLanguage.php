<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class SmsLanguage extends Model
{
    use LogModelAction;

    protected $fillable = [
        'feature',
        'default_lang',
        'platform',
        'sms_en',
        'sms_bn',
        'concat_char',
        'status',
        'updated_by'
    ];
}
