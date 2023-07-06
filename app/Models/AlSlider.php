<?php

namespace App\Models;

use App\Models\AlSliderComponentType;
use App\Models\AlSliderImage;
use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class AlSlider extends Model
{
    use LogModelAction;

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
        return $this->belongsTo(AlSliderComponentType::class, 'component_id');
    }

    public function sliderImages()
    {
        return $this->hasMany(AlSliderImage::class)->orderBy('sequence', 'asc');
    }

    public function componentTypes(){
        return $this->belongsTo(AlSliderComponentType::class,'component_id');
    }
}
