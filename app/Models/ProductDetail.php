<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $fillable =
        [
            'product_id',
            'balance_check',
            'details_en',
            'details_bn',
            'offer_details_en',
            'offer_details_bn'
        ];
}
