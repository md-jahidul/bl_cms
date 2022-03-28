<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class AlFaq extends Model
{
    use LogModelAction; 
    
    protected $guarded = ['id'];
}
