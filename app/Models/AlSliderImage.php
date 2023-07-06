<?php

namespace App\Models;

use App\Models\AlSlider;
use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class AlSliderImage extends Model
{
    use LogModelAction;

    protected $fillable = [
        'slider_id',
        'title_en',
        'title_bn',
        'start_date',
        'end_date',
        'alt_text',
        'redirect_url',
        'is_active',
        'image_url',
        'mobile_view_img',
        'display_order',
        'other_attributes',
        'icon_image',
        'icon_alt_text_en',
        'icon_alt_text_bn'
    ];

    protected $casts = [
        'other_attributes' => 'array'
    ];

    public function slider()
    {
        return $this->belongsTo(AlSlider::class);
    }
}
