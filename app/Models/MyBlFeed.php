<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyBlFeed extends Model
{
    protected $fillable = [
        'category_id',
        'type',
        'title',
        'description',
        'start_date',
        'end_date',
        'video_url',
        'audio_url',
        'image_url',
        'post_url',
        'file',
        'order',
        'status',
        'availability',
    ];

    protected $dates = ['start_date', 'end_date'];

    protected $casts = [
      'availability' => 'array',
    ];

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $value ? $value : now();
    }

    public function category()
    {
        return $this->belongsTo(MyBlFeedCategory::class, 'category_id', 'id');
    }
}
