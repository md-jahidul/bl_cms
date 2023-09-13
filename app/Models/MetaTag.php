<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetaTag extends Model
{
    protected $fillable = [
        'title', 'page_header', 'page_header_bn','schema_markup','dynamic_route_key', 'keywords',
        'description', 'page_id'
    ];


    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
