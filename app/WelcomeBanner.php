<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WelcomeBanner extends Model
{
    protected $fillable = [
        'title_en',
        'title_bn',
        'description_en',
        'description_bn',
        'banner_img',
        'created_by'
    ];
}
