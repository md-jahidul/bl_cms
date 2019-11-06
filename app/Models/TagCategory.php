<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagCategory extends Model
{
    protected $fillable = [ 'name_en', 'name_bn', 'alias' ];
}
