<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GenericComponentItem extends Model
{
    protected $fillable = [
        'component_key',
        'title_en',
        'title_bn',
        'display_order',
        'is_api_call_enable',
        'is_eligible',
        'android_version_code_min',
        'android_version_code_max',
        'ios_version_code_min',
        'ios_version_code_max',
        'generic_component_id',
        'generic_slider_id'
    ];

    public function component()
    {
        return $this->belongsTo(GenericComponent::class, 'generic_component_id', 'id');
    }
}
