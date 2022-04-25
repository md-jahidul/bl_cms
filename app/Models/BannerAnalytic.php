<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Slider;
use App\Models\SliderImage;
use App\Traits\LogModelAction;

class BannerAnalytic extends Model
{
    use LogModelAction;
    
    protected $fillable = [
        'banner_id',
        'view_count',
        'click_count'
    ];

    public function getBanner()
    {
        return $this->belongsTo(Banner::class, 'banner_id', 'id');
    }

    public function getBannePurchases(){

        return $this->hasOne(BannerProductPurchase::class, 'slider_id','slider_id')->where('slider_image_id', $this->slider_image_id);
    }

    public function getSlider()
    {
        return $this->belongsTo(Slider::class, 'slider_id', 'id');
    }

    public function getSliderImage()
    {
        return $this->belongsTo(SliderImage::class, 'slider_image_id', 'id');
    }
}
