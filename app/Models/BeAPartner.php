<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class BeAPartner extends Model
{
    use LogModelAction;
    
    protected $guarded = ['id'];

    protected $casts = [
       'banner_image' => 'array'
    ];
}
