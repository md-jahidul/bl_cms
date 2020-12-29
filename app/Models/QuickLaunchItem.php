<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuickLaunchItem extends Model
{
    protected $fillable = [
        'title_en', 'title_bn', 'image_url',
        'alt_text', 'alt_text_bn', 'link', 'link_bn',
        'is_external_link', 'image_name_en', 'image_name_bn',
        'type', 'status', 'display_order'
    ];
}
