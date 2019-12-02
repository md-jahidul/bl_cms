<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqQuestion extends Model
{
    protected $guarded = ['id'];

    public function scopeApp($builder)
    {
        return $builder->where('platform', '=', 'app');
    }

    public function category()
    {
        return $this->belongsTo(FaqCategory::class, 'category_id');
    }
}
