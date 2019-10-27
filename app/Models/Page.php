<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function shortCodes()
    {
        return $this->hasMany(ShortCode::class);
    }

    public function metaTags ()
    {
        return $this->hasMany(MetaTag::class);
    }
}
