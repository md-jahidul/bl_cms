<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppServiceTab extends Model
{
    protected $fillable = [
        'name_en',
        'name_bn',
        'alias',
        'banner_image_url',
        'banner_alt_text',
        'banner_alt_text_bn',
        'banner_image_mobile',
        'banner_name',
        'banner_name_bn',
        'url_slug',
        'url_slug_bn',
        'schema_markup',
        'page_header',
        'page_header_bn',
        'status',
        'created_by',
        'updated_by'
    ];
}
