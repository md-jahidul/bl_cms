<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RechargePackFilter extends Model
{
    protected $guarded = ['id'];

    /**
     * @param $builder
     * @return mixed
     */
    public function scopePrice($builder)
    {
        $type = OfferFilterType::where('slug', 'price')->first();
        return $builder->where('offer_filter_type_id', '=', $type->id);
    }

    /**
     * @param $builder
     * @return mixed
     */
    public function scopeInternet($builder)
    {
        $type = OfferFilterType::where('slug', 'internet')->first();
        return $builder->where('offer_filter_type_id', '=', $type->id);
    }

    /**
     * @param $builder
     * @return mixed
     */
    public function scopeValidity($builder)
    {
        $type = OfferFilterType::where('slug', 'validation')->first();
        return $builder->where('offer_filter_type_id', '=', $type->id);
    }

    /**
     * @param $builder
     * @return mixed
     */

    public function scopeActive($builder)
    {
        return $builder->where('is_active', '=', true);
    }

    /**
     * @param $builder
     * @return mixed
     */
    public function scopeSort($builder)
    {
        $type = OfferFilterType::where('slug', 'sort')->first();
        return $builder->where('offer_filter_type_id', '=', $type->id);
    }

    /**
     * @param $builder
     * @return mixed
     */
    public function scopeMinutes($builder)
    {
        $type = OfferFilterType::where('slug', 'minutes')->first();
        return $builder->where('offer_filter_type_id', '=', $type->id);
    }

    /**
     * @param $builder
     * @return mixed
     */
    public function scopeSms($builder)
    {
        $type = OfferFilterType::where('slug', 'sms')->first();
        return $builder->where('offer_filter_type_id', '=', $type->id);
    }

}
