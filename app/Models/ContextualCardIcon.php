<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContextualCardIcon extends Model
{
    protected $fillable = [
        'card_number',
        'category',
        'icon',
        'remark'
    ];
}
