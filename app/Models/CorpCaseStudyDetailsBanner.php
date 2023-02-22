<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorpCaseStudyDetailsBanner extends Model
{
    protected $fillable = [
        'details_id', 'banner_web', 'banner_mobile',
        'alt_text_en', 'alt_text_bn',
        'image_name_en', 'image_name_bn'
    ];
}
