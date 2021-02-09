<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BandhoSimeImage extends Model
{
    protected $fillable = [
        'id',
        'image_url',
        'is_delete'
    ];
}
