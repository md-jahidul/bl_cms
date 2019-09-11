<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MinuteOffer extends Model
{
    protected $table = 'minute_offers';
    protected $fillable = [
        'title',
        'volume',
        'validity',
        'price',
        'offer_code',
        'points'
    ];
}
