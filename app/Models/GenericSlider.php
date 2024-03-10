<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GenericSlider extends Model
{
    protected $fillable = [
        'title_en',
        'title_bn',
        'component_for',
        'component_size',
        'component_type',
        'scrollable',
        'icon',
        'is_title_show',
        'android_version_code_min',
        'android_version_code_max',
        'ios_version_code_min',
        'ios_version_code_max',
        'redirection_button_en',
        'redirection_button_bn',
        'redirection_button_deeplink',
        'is_card',
        'ad_unit_id'
    ];

    public function images(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(GenericSliderImage::class, 'generic_slider_id', 'id');
    }
}
