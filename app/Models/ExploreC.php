<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExploreC extends Model
{
    protected $fillable = [
        'title_en',
        'title_bn',
        'short_desc_en',
        'short_desc_bn',
        'button_lable_en',
        'button_lable_bn',
        // 'button_url_en',
        // 'button_url_bn',
        'image',
        'image_mobile',
        'img_alt_en',
        'img_alt_bn',
        'img_name_en',
        'img_name_bn',
        'start_date',
        'end_date',
        'status',
        'display_order',
        'color',
        'slug_en',
        'slug_bn',
    ];

    public const EXPLORE_C_STATUS_ENUM = [0 => 'Inactive', 1 => 'Active'];
}
