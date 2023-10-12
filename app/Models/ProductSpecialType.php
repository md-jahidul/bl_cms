<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class ProductSpecialType extends Model
{
    use LogModelAction;

    protected $fillable = [
        'name_en',
        'name_bn',
        'slug',
        'icon',
        'display_order',
        'status'
    ];

    public function visibilityStatus(): bool
    {

        if ($this->status == 1) return true;
        
        return false;
    }
}
