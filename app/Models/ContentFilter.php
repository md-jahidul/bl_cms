<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentFilter extends Model
{
    protected $fillable = [
        'content_type',
        'content_for',
        'title_en',
        'title_bn',
        'display_order',
        'status'
    ];
}
