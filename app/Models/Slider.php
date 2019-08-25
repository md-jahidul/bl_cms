<?php

namespace App\Models;

use App\SliderType;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['slider_type_id', 'title', 'description', 'short_code'];

    public function sliderType(){
        return $this->belongsTo(SliderType::class);
    }
 
    public function sliderImages(){
        return $this->hasMany(SliderImage::class);
    }
    
}
