<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GenericShortcut extends Model
{
    protected $fillable = [
        'title',
        'title_bn',
        'icon',
        'component_identifier',
        'is_default',
        'customer_type'
    ];
}

