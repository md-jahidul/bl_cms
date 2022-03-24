<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class PasswordHistory extends Model
{
    use LogModelAction;
    
    protected $guarded = [];

    public function post()
    {
        return $this->belongsTo('App\User');
    }
}
