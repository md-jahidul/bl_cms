<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    use LogModelAction;
    
    protected $guarded = ['id'];
}
