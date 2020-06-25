<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPriceSlab extends Model
{
    protected $fillable = ['range_name', 'product_code', 'range_start', 'range_end'];
}
