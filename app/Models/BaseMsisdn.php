<?php

namespace  App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class BaseMsisdn extends Model
{
    use LogModelAction;
    
    protected $fillable = [
        'group_id',
        'msisdn',
        'created_at'
    ];
}
