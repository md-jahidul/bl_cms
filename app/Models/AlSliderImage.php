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
        'alt_text_bn',
        'redirect_url',
        'is_active',
        'image_url',
        'mobile_view_img',
        'image_name',
        'image_name_bn',
        'display_order',
        'other_attributes',
    ];

    protected $casts = [
        'other_attributes' => 'array'
    ];

    public function slider()
    {
        return $this->belongsTo(AlSlider::class);
    }
}
