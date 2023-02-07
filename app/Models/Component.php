<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use LogModelAction;
    
    protected $fillable = [
        'section_details_id',
        'page_type',
        'title_en',
        'title_bn',
        'extra_title_en',
        'extra_title_bn',
        'button_en',
        'button_bn',
        'button_link',
        'slug',
        'description_en',
        'description_bn',
        'editor_en',
        'editor_bn',
        'image',
        'alt_text',
        'alt_text_bn',
        'image_name_en',
        'image_name_bn',
        'video',
        'alt_links',
        'offer_type',
        'offer_type_id',
        'component_type',
        'component_order',
        'multiple_attributes',
        'status',
        'other_attributes',
        'deleted_at'
    ];

    protected $casts = [
        'multiple_attributes' => 'array',
        'other_attributes' => 'array',
    ];


    public function componentMultiData()
    {
        return $this->hasMany(ComponentMultiData::class, 'component_id', 'id');
    }

}
