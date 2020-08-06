<?php

namespace App\Models;

use App\SliderType;
use Illuminate\Database\Eloquent\Model;

class SliderImage extends Model
{
    protected $fillable = [
            'slider_id',
            'title',
            'alt_text',
            'url_btn_label',
            'redirect_url',
            'description',
            'is_active',
            'image_url',
            'sequence',
            'other_attributes',
            'user_type',
            'start_date',
            'end_date',
            'display_type',
            'web_deep_link'
    ];

    protected $casts = [
        'other_attributes' => 'array'
    ];

    public function slider()
    {
        return $this->belongsTo(Slider::class);
    }
}
