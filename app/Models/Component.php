<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
   protected $fillable = [
   	'section_details_id',
    'title_en',
    'title_bn',
    'slug',
    'description_en',
    'description_bn',
    'editor_en',
    'editor_bn',
    'image',
    'alt_text',
    'video',
    'alt_links',
    'component_type',
    'component_order',
    'multiple_attributes',
    'status',
    'other_attributes',
    'deleted_at'
 	];
}
