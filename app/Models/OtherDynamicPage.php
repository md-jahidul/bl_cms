<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class OtherDynamicPage extends Model
{
    protected $table = 'other_dynamic_page';

    protected $fillable = [
        'page_header', 'page_header_bn', 'schema_markup',
        'banner_image_url', 'banner_mobile_view',
        'alt_text', 'alt_text_bn', 'banner_name', 'banner_name_bn',
        'page_name_en', 'page_name_bn', 'url_slug', 'url_slug_bn',
        'page_content_en', 'page_content_bn', 'created_by', 'updated_by'
    ];

    public function searchableFeature(): MorphMany
    {
        return $this->morphMany(SearchableData::class, 'featureable');
    }
}
