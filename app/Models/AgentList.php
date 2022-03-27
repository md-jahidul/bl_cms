<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class AgentList extends Model
{
    use LogModelAction;
    protected $fillable = [
        'name',
        'email',
        'msisdn',
        'address',
        'is_delete',
        'is_active'
    ];
}
