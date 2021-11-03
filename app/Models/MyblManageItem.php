<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class MyblManageItem extends Model
{
    protected $fillable = [
        'manage_categories_id',
        'type',
        'title_en',
        'title_bn',
        'component_identifier',
        'image_url',
        'show_for_guest',
        'other_info',
        'display_order',
        'deep_link_slug',
        'status'
    ];

    protected $casts = [
        'other_info' => 'array'
    ];

    /**
     * @return MorphOne
     */
    public function dynamicLinks(): MorphOne
    {
        return $this->morphOne(MyblDynamicDeeplink::class, 'referenceable');
    }
}
