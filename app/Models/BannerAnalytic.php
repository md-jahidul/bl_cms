<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerAnalytic extends Model
{
    protected $fillable = [
        'banner_id',
        'view_count',
        'click_count'
    ];

    public function getBanner()
    {
        return $this->belongsTo(Banner::class, 'banner_id', 'id');
    }
}
