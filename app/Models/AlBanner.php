<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class AlBanner extends Model
{
    
    use LogModelAction;

    protected $fillable = [
        'section_id',
        'section_type',
        'title_en',
        'title_bn',
        'desc_en',
        'desc_bn',
        'image',
        'alt_text_en',
        'alt_text_bn',
        'image_name_en',
        'image_name_bn',
        'other_attributes',
    ];

    protected $casts = [
        'other_attributes' => 'array',
    ];
}
