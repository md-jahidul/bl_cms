<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorpInitiativeTabComponent extends Model
{
    protected $fillable = [
        'initiative_tab_id',
        'component_type',
        'component_title_en',
        'component_title_bn',
        'title_en',
        'title_bn',
        'editor_en',
        'editor_bn',
        'multiple_attributes',
        'component_order',
        'status',
    ];

    protected $casts = [
        'multiple_attributes' => 'array'
    ];
}
