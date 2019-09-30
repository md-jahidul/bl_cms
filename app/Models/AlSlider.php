<?php

namespace App\Models;

use App\Models\AlSliderComponentType;
use App\Models\AlSliderImage;
use Illuminate\Database\Eloquent\Model;

class AlSlider extends Model
{
    protected $fillable = [
        'component_id',
        'title_en',
        'title_bn',
        'short_code',
        'other_attributes'
    ];

    protected $casts = [
        'other_attributes' => 'array'
    ];

    public function type()
    {
        return $this->belongsTo(AlSliderComponentType::class, 'id');
    }

    public function sliderImages(){
        return $this->hasMany(AlSliderImage::class)->orderBy('sequence', 'asc');
    }
}
