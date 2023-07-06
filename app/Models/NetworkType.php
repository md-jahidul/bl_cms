<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NetworkType extends Model
{
    protected $table = 'network_types';

    protected $casts = [
        'other_attributes' => 'array'
    ];
    protected $fillable = [
        'title_en',
        'title_bn',
        'alt_text_en',
        'alt_text_bn',
        'image_url',
    ];
}
