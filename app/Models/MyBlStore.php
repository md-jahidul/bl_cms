<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyBlStore extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function storeCategories()
    {
        return $this->belongsTo(MyBlStoreCategory::class, 'category_id');
    }
}
