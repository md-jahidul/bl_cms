<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class MyBlStoreApp extends Model
{
    use LogModelAction;
    
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sliderImages()
    {
        return $this->hasMany(MyBlStoreSliderImage::class, 'store_app_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function stores()
    {
        return $this->belongsToMany(MyBlStore::class, 'my_bl_store_app',
            'app_id', 'store_id');
    }
}
