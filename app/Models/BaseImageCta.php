<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseImageCta extends Model
{
    protected $fillable = [
        'group_id',
        'banner_id',
        'action_name',
        'action_url_or_code',
        'status',
    ];
}
