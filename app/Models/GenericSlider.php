<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GenericSlider extends Model
{
    protected $fillable= ['title_en', 'title_bn', 'component_for'];

    public function images(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(GenericSliderImage::class, 'generic_slider_id', 'id');
    }
}
