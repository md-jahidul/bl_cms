<?php

namespace App\Models;

use App\Models\OfferFilterType;
use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class MixedBundleFilter extends Model
{
    use LogModelAction;
    
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

    public function scopeMinutes($builder)
    {
        $type = OfferFilterType::where('slug', 'minutes')->first();
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
