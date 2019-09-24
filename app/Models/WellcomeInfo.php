<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WellcomeInfo extends Model
{
    protected $fillable = [
        'guest_salutation',
        'user_salutation',
        'guest_message',
        'user_message',
        'icon'
    ];
}
