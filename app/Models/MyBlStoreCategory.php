<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyBlStoreCategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_en',
        'name_bn',
        'slug'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    /*public function subCategories()
    {
        return $this->hasMany(MyBlStoreSubCategory::class, 'category_id');
    }*/
}
