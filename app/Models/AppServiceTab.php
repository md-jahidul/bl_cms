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
        'banner_image_mobile',
        'banner_name',
        'url_slug',
        'schema_markup',
        'page_header',
        'status',
    ];
}
