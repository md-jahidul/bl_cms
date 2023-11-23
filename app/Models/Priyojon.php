<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class Priyojon extends Model
{
    use LogModelAction;

    protected $fillable = [
        'parent_id',
        'component_type',
        'title_en',
        'title_bn',
        'desc_en',
        'desc_bn',
        'banner_image_url',
        'banner_video_url',
        'is_images',
        'banner_mobile_view',
        'alt_text_en',
        'alias',
        'alt_text_bn',
        'banner_name',
        'banner_name_bn',
        'url',
        'url_slug_en',
        'url_slug_bn',
        'page_header',
        'page_header_bn',
        'schema_markup',
        'status'
    ];
}
