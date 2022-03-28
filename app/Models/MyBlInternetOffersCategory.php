<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class MyBlInternetOffersCategory extends Model
{
    use Sluggable, LogModelAction;

    protected $guarded = ['id'];

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

    public function dynamicLinks()
    {
        return $this->morphOne(MyblDynamicDeeplink::class, 'referenceable');
    }
}
