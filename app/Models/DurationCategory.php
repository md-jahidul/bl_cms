<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class DurationCategory extends Model
{
    use LogModelAction;
    
    protected $fillable = ['name_en', 'name_bn', 'alias', 'days'];
}
