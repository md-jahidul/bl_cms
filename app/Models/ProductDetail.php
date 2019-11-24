<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $fillable =
        [
            'product_id',
            'details_en',
            'details_bn',
            'offer_details_en',
            'offer_details_bn',
            'other_attributes'
        ];

    protected $casts = [
        'other_attributes' => 'array'
    ];
}
