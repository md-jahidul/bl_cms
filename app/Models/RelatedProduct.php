<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelatedProduct extends Model
{
    protected $fillable = ['product_id', 'related_product_id'];
}
