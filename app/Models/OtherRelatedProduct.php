<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtherRelatedProduct extends Model
{
    protected $fillable = ['product_id', 'other_offer_id', 'related_product_id'];
}
