<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class AboutUsEcareer extends Model
{
    use LogModelAction;
    
    protected $guarded = ['id'];
}
