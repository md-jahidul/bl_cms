<?php

namespace App\Models;

use App\SliderType;
use Illuminate\Database\Eloquent\Model;

class SliderImage extends Model
{
    protected $fillable = [
            'title',
            'alt_text',
            'url_btn_label',
            'redirect_url',
            'description',
            'is_active',
            'image_url',
            'other_attributes',
    ];

    public function slider(){
        return $this->belongsTo(Slider::class);
    }
}
