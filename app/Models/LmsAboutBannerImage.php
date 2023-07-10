<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LmsAboutBannerImage extends Model
{
    protected $guarded = ['id'];

    public function searchableFeature()
    {
        return $this->morphMany(SearchableData::class, 'featureable');
    }
}
