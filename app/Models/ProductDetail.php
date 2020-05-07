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
            'other_attributes',
            'banner_image_url',
            'banner_image_mobile',
            'banner_name',
            'banner_alt_text',
            'url_slug',
            'schema_markup',
            'page_header',
        ];

    protected $casts = [
        'other_attributes' => 'array'
    ];
}
