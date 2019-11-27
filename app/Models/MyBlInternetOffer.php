<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyBlInternetOffer extends Model
{
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(\MyBlInternetOfferCategorySeeder::class, 'category_id');
    }

}
