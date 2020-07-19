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
        'category_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function StoreCategory()
    {
        return $this->belongsTo(MyBlStoreCategory::class);
    }

}
