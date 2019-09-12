<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NearbyOffer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'nearby_offers';
    protected $fillable = [
        'title',
        'vendor',
        'location',
        'type',
        'offer',
        'image',
        'offer_code'
     ];
    
}