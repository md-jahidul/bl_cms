<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaBannerImage extends Model
{
    protected $guarded = ['id', 'tvc_banner_id', 'landing_page_id'];
}
