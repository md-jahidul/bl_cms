<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Priyojon extends Model
{
    protected $fillable = [
        'parent_id', 'title_en', 'title_bn', 'banner_image_url', 'banner_mobile_view', 'alt_text_en', 'url', 'status'
    ];
}
