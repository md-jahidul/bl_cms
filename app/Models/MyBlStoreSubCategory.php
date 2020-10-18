<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyBlStoreSubCategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_en',
        'name_bn',
        'slug',
        'icon',
        'category_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categories()
    {
        return $this->belongsTo(MyBlStoreCategory::class, 'category_id');
    }

}
