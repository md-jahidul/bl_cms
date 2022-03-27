<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class AppServiceTab extends Model
{
    use LogModelAction;
    
    protected $fillable = [
        'name_en',
        'name_bn',
        'alias',
        'banner_image_url',
        'banner_alt_text',
        'banner_alt_text_bn',
        'banner_image_mobile',
        'banner_name',
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
