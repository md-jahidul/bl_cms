<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternetOffer extends Model
{
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