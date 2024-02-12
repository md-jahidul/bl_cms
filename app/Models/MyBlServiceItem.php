<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyBlServiceItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'my_bl_service_id',
        'title_en',
        'title_bn',
        'image_url',
        'alt_text',
        'sequence',
        'status',
        'deeplink',
        'component_identifier',
        'tags',
        'is_highlight',
        'android_version_code_min',
        'android_version_code_max',
        'ios_version_code_min',
        'ios_version_code_max',
    ];

    /**
     * Get the related service for this item.
     */
    public function service()
    {
        return $this->belongsTo(MyBlService::class, 'my_bl_service_id');
    }
}
