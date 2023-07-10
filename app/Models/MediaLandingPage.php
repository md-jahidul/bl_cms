<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class MediaLandingPage extends Model
{
    use LogModelAction;

    protected $guarded = ['id'];

    protected $casts = [
        'items' => 'array',
        'slider_items' => 'array'
    ];
}
