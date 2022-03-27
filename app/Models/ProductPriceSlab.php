<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class ProductPriceSlab extends Model
{
    use LogModelAction;
    
    protected $fillable = ['range_name', 'product_code', 'range_start', 'range_end'];
}
