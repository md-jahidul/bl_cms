<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class BandhoSimeImage extends Model
{
    use LogModelAction;
    
    protected $fillable = [
        'id',
        'image_url',
        'is_delete'
    ];
}
