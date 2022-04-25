<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class MyBlProductCategory extends Model
{
    use Sluggable;
    use LogModelAction;

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
                'source' => 'name'
            ]
        ];
    }

}
