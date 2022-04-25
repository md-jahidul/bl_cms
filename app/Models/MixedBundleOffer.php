<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class MixedBundleOffer extends Model
{
    use LogModelAction;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mixed_bundle_offers';
    protected $fillable = [
        'title',
        'internet',
        'minutes',
        'sms',
        'validity',
        'price',
        'points',
        'offer_code',
        'tag'
    ];
}
