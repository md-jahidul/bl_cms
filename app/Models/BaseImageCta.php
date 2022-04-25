<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class BaseImageCta extends Model
{
    use LogModelAction;
    
    protected $fillable = [
        'group_id',
        'banner_id',
        'action_name',
        'action_url_or_code',
        'status',
    ];
}
