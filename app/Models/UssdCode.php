<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UssdCode extends Model
{
    protected $table = 'ussd_codes';
    protected $fillable = [
        'title',
        'code',
        'purpose',
        'provider',
    ];
    //
}
