<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'name',
        'code',
        'redirect_url',
        'image_name',
        'image_path'
    ];
}
