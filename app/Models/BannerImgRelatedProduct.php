<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerImgRelatedProduct extends Model
{
    protected $guarded = ['id', 'banner_related_id'];
    protected $casts = [
        'related_product_id' => 'array'
    ];
}
