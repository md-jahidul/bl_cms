<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AmarOffer extends Model
{
    protected $fillable =[
        'title',
        'internet',
        'minutes',
        'sms',
        'validity',
        'price',
        'offer_code',
        'tag',
        'points'
    ];
}
