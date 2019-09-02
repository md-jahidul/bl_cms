<?php

namespace App\Models;

use App\Models\SliderType;
use App\Models\SliderImage;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'slider_type_id', 
        'title', 
        'description', 
        'short_code',
        'url_btn_label',
        'is_active',
        'sequence',
        'url'
    ];

    public function sliderType(){
        return $this->belongsTo(SliderType::class);
    }
 
    public function sliderImages(){
        return $this->hasMany(SliderImage::class)->orderBy('sequence', 'asc');
    }
    
}
