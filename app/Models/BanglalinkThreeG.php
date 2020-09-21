<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BanglalinkThreeG extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'other_attributes' => 'array'
    ];
}
