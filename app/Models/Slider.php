<?php

namespace App\Models;

use App\Models\SliderComponentTypes;
use App\Models\SliderImage;
use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use LogModelAction;

    protected $fillable = [
        'component_id',
        'title',
        'description',
        'short_code',
        'platform',
        'slider',
        'other_attributes',
        'position',
        'component_for'
    ];

    protected $casts = [
        'other_attributes' => 'array'
    ];


    public function SliderComponentTypes()
    {
        return $this->belongsTo(SliderComponentType::class, 'component_id', 'id');
    }

    public function sliderImages()
    {
        return $this->hasMany(SliderImage::class)->orderBy('sequence', 'desc');
    }
}
