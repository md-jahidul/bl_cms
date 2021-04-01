<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductActivity extends Model
{
    protected $fillable = [
        'user_id',
        'product_code',
        'activity_type',
        'platform',
        'updated_data'
    ];

    protected $casts = [
        'updated_data' => 'array'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
