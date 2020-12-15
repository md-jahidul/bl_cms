<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentList extends Model
{
    protected $fillable = [
        'name',
        'email',
        'msisdn',
        'address',
        'is_delete',
        'is_active'
    ];
}
