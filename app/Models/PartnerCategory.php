<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerCategory extends Model
{
    protected $guarded = ['id'];

    public function partner()
    {
        return $this->hasOne(Partner::class);
    }

    public function searchableFeature()
    {
        return $this->morphMany(SearchableData::class, 'featureable');
    }
}
