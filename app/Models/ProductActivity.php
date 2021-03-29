<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductActivity extends Model
{
    protected $fillable = [
        'user_id',
        'product_code',
        'activity_type',
        'platform'
    ];
}
