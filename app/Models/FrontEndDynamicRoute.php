<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FrontEndDynamicRoute extends Model
{
    use LogModelAction;
    
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'children' => 'array'
    ];
}
