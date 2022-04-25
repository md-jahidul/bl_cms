<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class InternetOffer extends Model
{
    use LogModelAction;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'internet_offers';
    protected $fillable = [
        'title',
        'volume',
        'validity',
        'price',
        'offer_code',
        'points'
    ];
}
