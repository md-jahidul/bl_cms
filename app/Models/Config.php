<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use LogModelAction;
    
    protected $fillable = ['key', 'value'];
}
