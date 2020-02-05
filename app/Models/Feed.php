<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    protected $fillable = [
        'category_id',
        'type',
        'source',
        'title',
        'description',
        'video_url',
        'image_url',
        'audio_url',
        'preview_image',
        'custom_media_url',
        'remarks',
        'start_date',
        'end_date',
        'status',
        'created_by',
        'approved_by'
    ];

    public function category()
    {
        return $this->belongsTo(FeedCategory::class);
    }
}
