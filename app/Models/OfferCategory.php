<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferCategory extends Model
{

    protected $fillable = ['name_en', 'name_bn', 'banner_image_url',
        'banner_alt_text', 'banner_image_mobile', 'url_slug',
        'page_header', 'page_header_bn', 'banner_name',
        'schema_markup', 'other_attributes', 'created_by', 'updated_by'];

    protected $casts = [
        'other_attributes' => 'array'
    ];

    public function scopePackageType($query, $type = 'prepaid')
    {
        return  (strtolower($type) == 'prepaid') ? $query->where('parent_id', 0) : $query->whereIn('alias', ['internet', 'bundles', 'packages', 'others'])->where('parent_id', 0);
    }

    public function type()
    {
        return $this->belongsTo(SimCategory::class);
    }

    public function children()
    {
        return $this->hasMany(OfferCategory::class, 'parent_id', 'id');
    }

}
