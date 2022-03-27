<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class CorporateCrStrategySection extends Model
{
    use LogModelAction;
    
    protected $guarded = ['id'];
}
