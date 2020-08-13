<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MyBlFeedCategory extends Model
{

    protected $fillable = [
        'parent_id', 'name', 'slug' , 'order' , 'status'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function feeds()
    {
        return $this->hasMany(MyBlFeed::class, 'category_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class);
    }
}
