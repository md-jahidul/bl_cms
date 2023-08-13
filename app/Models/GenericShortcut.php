<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GenericShortcut extends Model
{
    protected $fillable = [
        'title_en',
        'title_bn',
        'generic_shortcut_master_id',
        'icon',
        'component_identifier',
        'is_default',
        'customer_type',
        'sort_order',
        'other_info',
        'deep_link'
    ];
}

