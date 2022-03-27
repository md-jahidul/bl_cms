<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class AmarOffer extends Model
{
    use LogModelAction;
    
    protected $fillable = [
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
