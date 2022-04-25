<?php

namespace  App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use LogModelAction;
    
    protected $fillable = [
        'name',
        'code',
        'redirect_url',
        'image_name',
        'image_path'
    ];
}
