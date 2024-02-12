<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GenericRail extends Model
{
    protected $fillable = [
        'title_en',
        'title_bn',
        'component_for',
        'is_title_show',
        'android_version_code_min',
        'android_version_code_max',
        'ios_version_code_min',
        'ios_version_code_max',
        'cta_name_en',
        'cta_name_bn',
        'deeplink',
        'icon',
    ];

    public function items(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(GenericRailItem::class, 'generic_rail_id', 'id');
    }
}
