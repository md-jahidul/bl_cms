<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SmsPackFilter
 * @package App\Models
 */
class SmsPackFilter extends Model
{
    protected $guarded = ['id'];

    public function scopePrice($builder)
    {
        $type = OfferFilterType::where('slug', 'price')->first();
        return $builder->where('offer_filter_type_id', '=', $type->id);
    }

    public function scopeSms($builder)
    {
        $type = OfferFilterType::where('slug', 'sms')->first();
        return $builder->where('offer_filter_type_id', '=', $type->id);
    }

    public function scopeValidity($builder)
    {
        $type = OfferFilterType::where('slug', 'validation')->first();
        return $builder->where('offer_filter_type_id', '=', $type->id);
    }

    public function scopeSort($builder)
    {
        $type = OfferFilterType::where('slug', 'sort')->first();
        return $builder->where('offer_filter_type_id', '=', $type->id);
    }


    public function scopeActive($builder)
    {
        return $builder->where('is_active', '=', true);
    }
}
