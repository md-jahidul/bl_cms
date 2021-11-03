<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class MyblAppMenu extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'other_info' => 'array'
    ];

    public function children(): HasMany
    {
        return $this->hasMany(MyblAppMenu::class, 'parent_id', 'id');
    }

    /**
     * @return MorphOne
     */
    public function dynamicLinks(): MorphOne
    {
        return $this->morphOne(MyblDynamicDeeplink::class, 'referenceable');
    }

//    public function parent()
//    {
//        return $this->hasOne(MyblAppMenu::class, 'id', 'parent_id');
//    }
}
