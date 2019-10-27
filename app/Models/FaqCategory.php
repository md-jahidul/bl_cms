<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    use Sluggable;

    protected $guarded = ['id'];
    //public  $primaryKey = 'slug';

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function scopeApp($builder)
    {
        return $builder->where('platform', '=', 'app');
    }

    public function questions()
    {
        return $this->hasMany(FaqQuestion::class, 'category_id');
    }
}
