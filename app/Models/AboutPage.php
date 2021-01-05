<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    protected $fillable = [
        'slug',
        'details_en',
        'details_bn',
        'left_side_img',
        'right_side_ing',
        'left_img_name_en',
        'left_img_name_bn',
        'left_img_alt_text_en',
        'left_img_alt_text_bn',
        'right_img_name_en',
        'right_img_name_bn',
        'right_img_alt_text_en',
        'right_img_alt_text_bn',
        'other_attributes',
    ];

    protected $casts = [
        'other_attributes' => 'array',
    ];
}
