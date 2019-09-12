<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SliderImage extends Model
{
    protected $fillable = [
        'slider_id',
        'title',
        'description',
        'image_url',
        'alt_text',
        'url_btn_label',
        'redirect_url',
        'sequence',
        'is_active',
        'other_attributes'
    ];
}
