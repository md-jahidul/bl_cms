<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCore extends Model
{
    protected $guarded = ['id'];


    public function product()
    {
        return $this->hasOne(Product::class, 'product_code', 'product_code');
    }

    public function sim_category()
    {
        return $this->belongsTo(SimCategory::class, 'product_sim_package', 'id');
    }

    public function offer_category()
    {
        return $this->belongsTo(OfferCategory::class, 'product_sim_package', 'id');
    }

    public function scopeCategory($query, $type)
    {
        return $query->whereHas('sim_category', function ($q) use ($type) {
            $q->where('alias', $type);
        });
    }

}
