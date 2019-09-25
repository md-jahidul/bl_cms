<?php

namespace App\Models;

use App\Models\SliderComponentTypes;
use App\Models\SliderImage;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'component_id',
        'title',
        'description',
        'short_code',
        'platform',
        'slider',
        'other_attributes'
    ];

    protected $casts = [
        'other_attributes' => 'array'
    ];

    public function type()
    {
        return $this->belongsTo(SliderComponentType::class, 'id');
    }

    public function SliderComponentTypes(){
        return $this->belongsTo(SliderComponentTypes::class,'component_id','id');
    }

    public function sliderImages(){
        return $this->hasMany(SliderImage::class)->orderBy('sequence', 'asc');
    }

}
