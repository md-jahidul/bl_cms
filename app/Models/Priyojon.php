<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Priyojon extends Model
{
    protected $fillable = [
        'parent_id',
        'title_en',
        'title_bn',
        'banner_image_url',
        'banner_mobile_view',
        'alt_text_en',
        'alt_text_bn',
        'banner_name',
        'banner_name_bn',
        'url',
        'alias',
        'url_slug_en',
        'url_slug_bn',
        'page_header',
        'page_header_bn',
        'schema_markup',
        'status'
    ];
}
