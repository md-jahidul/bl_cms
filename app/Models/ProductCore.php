<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCore extends Model
{
    protected $fillable = ['product_code'];

    public function products()
    {
        return $this->hasOne(Product::class, 'product_code', 'product_code');
    }

}
