<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToffeeProduct extends Model
{
    protected $fillable = [
            'type',
            'commercial_name_en',
            'commercial_name_bn',
            'internet',
            'validity',
            'validity_unit',
            'price',
            'points',
            'offer_breakdown_en',
            'offer_breakdown_bn',
            'display_sd_vat_tax',
            'product_code',
            'has_autorenew',
            'is_recharge',
            'image',
            'status',
            'connection_type',
            'title',
            'content_ids'
        ];
}
