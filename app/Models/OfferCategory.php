<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class OfferCategory extends Model
{
    use LogModelAction;

    protected $fillable = ['name_en', 'name_bn', 'banner_image_url',
        'banner_alt_text', 'banner_alt_text_bn', 'banner_image_mobile', 'url_slug', 'url_slug_bn',
        'page_header', 'page_header_bn', 'banner_name', 'banner_name_bn',
        'schema_markup', 'other_attributes', 'created_by', 'updated_by',
        'postpaid_banner_image_url',
        'postpaid_banner_image_mobile',
        'postpaid_alt_text',
        'postpaid_alt_text_bn',
        'postpaid_banner_name',
        'postpaid_banner_name_bn',
        'postpaid_schema_markup',
        'postpaid_page_header',
        'postpaid_page_header_bn',
        'postpaid_url_slug',
        'postpaid_url_slug_bn'
    ];

    protected $casts = [
        'other_attributes' => 'array'
    ];

    public function scopePackageType($query, $type = 'prepaid')
    {
        return  (strtolower($type) == 'prepaid') ? $query->where('parent_id', 0) : $query->whereIn('alias', ['internet', 'voice', 'bundles', 'packages', 'others'])->where('parent_id', 0);
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
