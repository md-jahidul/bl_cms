<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsOffer extends Model
{
    protected $table = 'sms_offers';
    protected $fillable = [
        'title',
        'volume',
        'validity',
        'price',
        'offer_code',
        'points'
    ];
}
