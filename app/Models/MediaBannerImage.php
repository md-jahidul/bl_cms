<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class MediaBannerImage extends Model
{
    use LogModelAction;

    protected $guarded = ['id', 'tvc_banner_id', 'landing_page_id'];
}
