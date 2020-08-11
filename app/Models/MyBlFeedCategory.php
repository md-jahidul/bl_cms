<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class MyBlFeedCategory extends Model
{
    use Sluggable;

    protected $fillable = [
        'parent_id', 'name', 'slug' , 'order' , 'status'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function feeds()
    {
        return '';
    }

    public function parent()
    {
        return $this->belongsTo(self::class);
    }
}
