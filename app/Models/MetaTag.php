<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetaTag extends Model
{
    protected $fillable = ['title', 'keywords', 'description'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
