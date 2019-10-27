<?php

namespace App\Models;

use App\Models\AlSlider;
use Illuminate\Database\Eloquent\Model;

class AlSliderImage extends Model
{
    protected $fillable = [
        'slider_id',
        'title_en',
        'title_bn',
        'alt_text',
        'redirect_url',
        'is_active',
        'image_url',
        'display_order',
        'other_attributes',
    ];

    protected $casts = [
        'other_attributes' => 'array'
    ];

    public function slider(){
        return $this->belongsTo(AlSlider::class);
    }
}
