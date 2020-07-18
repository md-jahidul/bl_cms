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
        'name',
        'slug',
        'category_id',
    ];

    public function StoreCategory()
    {
        return $this->belongsTo(MyBlStoreCategory::class, 'category_id');
    }
}
