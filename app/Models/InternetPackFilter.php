<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternetPackFilter extends Model
{
    protected $guarded = ['id'];

    public function scopePrice($builder)
    {
        $type = OfferFilterType::where('slug', 'price')->first();
        return $builder->where('offer_filter_type_id', '=', $type->id);
    }

    public function scopeInternet($builder)
    {
        $type = OfferFilterType::where('slug', 'internet')->first();
        return $builder->where('offer_filter_type_id', '=', $type->id);
    }

    public function scopeValidity($builder)
    {
        $type = OfferFilterType::where('slug', 'validation')->first();
        return $builder->where('offer_filter_type_id', '=', $type->id);
    }


    public function scopeActive($builder)
    {
        return $builder->where('is_active', '=', true);
    }
}
