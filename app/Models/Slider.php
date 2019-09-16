<?php

namespace App\Models;

use App\Models\SliderComponentType;
//use App\SliderImage;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['slider_type_id', 'title', 'description', 'short_code'];

    public function type(){
        return $this->belongsTo(SliderComponentType::class,'id');
    }

    public function sliderImages(){
        return $this->hasMany(SliderImage::class);
    }

}
