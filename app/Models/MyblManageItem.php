<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'status'
    ];

    protected $casts = [
        'other_info' => 'array'
    ];
}
