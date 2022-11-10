<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class ContentComponent extends Model
{
    use LogModelAction;

    protected $fillable = [
        'component_key',
        'title_en',
        'title_bn',
        'is_api_call_enable',
        'display_order',
        'is_eligible'
    ];
}
