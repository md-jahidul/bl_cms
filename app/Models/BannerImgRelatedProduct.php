<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class BannerImgRelatedProduct extends Model
{
    use LogModelAction;

    protected $guarded = ['id', 'banner_related_id'];
    protected $casts = [
        'related_product_id' => 'array'
    ];
}
