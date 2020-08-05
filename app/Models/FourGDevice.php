<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FourGDevice extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'body_tag_id' => 'array'
    ];
}
