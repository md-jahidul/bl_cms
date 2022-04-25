<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class BanglalinkThreeG extends Model
{
    use LogModelAction;
    
    protected $guarded = ['id'];

    protected $casts = [
        'other_attributes' => 'array'
    ];
}
