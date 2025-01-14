<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class AlFaqCategory extends Model
{
    use LogModelAction;
    protected $fillable = ['description_en', 'description_bn', 'updated_by'];
}
