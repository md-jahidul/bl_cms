<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MyBlFeedCategory
 * @package App\Models
 */
class MyBlFeedCategory extends Model
{
    use Sluggable;

    protected $fillable = [
        'title', 'slug' , 'ordering'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
