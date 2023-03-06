<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GenericShortcutMaster extends Model
{
    protected $fillable = [
        'title_en',
        'title_bn',
        'component_for',
        'status'
    ];
}
