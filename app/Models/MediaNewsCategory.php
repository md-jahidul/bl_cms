<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaNewsCategory extends Model
{
    protected $guarded = ['id'];

    public function mediaPressNewsEvents()
    {
        return $this->hasMany(MediaPressNewsEvent::class);
    }
}
