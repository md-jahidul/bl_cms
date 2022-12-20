<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortCode extends Model
{

    protected $fillable = [
        'page_id',
        'title_en',
        'title_bn',
        'other_attributes'
    ];

    protected $casts = [
        'other_attributes' => 'array'
    ];
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function slider()
    {
        return $this->belongsTo(AlSlider::class,'component_id');
    }
}
