<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class MinuteOffer extends Model
{
    use LogModelAction;

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
