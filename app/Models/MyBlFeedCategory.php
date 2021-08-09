<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;

class MyBlFeedCategory extends Model
{

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->ordering = optional(self::latest('ordering')->first())->ordering+1;
        });
    }

    protected $fillable = [
        'parent_id', 'title', 'slug' , 'ordering' , 'status'
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
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

    /**
     * @return MorphMany
     */
    public function dynamicLinks()
    {
        return $this->morphOne(MyblDynamicDeeplink::class, 'referenceable');
    }
}
