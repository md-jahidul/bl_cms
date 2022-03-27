<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class CorporateRespSection extends Model
{
    use LogModelAction;
    
    protected $guarded = ['id'];
}
