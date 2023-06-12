<?php

namespace App\Models\FIFA;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['team_name', 'team_flag', 'group_name'];
}
