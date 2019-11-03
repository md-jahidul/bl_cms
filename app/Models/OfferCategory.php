<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferCategory extends Model
{
    public function scopeType($query, $type = 'prepaid')
    {
        return  (strtolower( $type ) == 'prepaid') ? $query : $query->whereIn('alias', ['internet', 'packages', 'others']);
    }
}
