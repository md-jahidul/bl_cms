<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class NearbyOffer extends Model
{
    use LogModelAction;
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
        'validity',
        'type',
        'offer',
        'image',
        'offer_code'
     ];
}
