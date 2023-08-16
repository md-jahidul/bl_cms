<?php

namespace App\Models\BlLab;

use Illuminate\Database\Eloquent\Model;

class BlLabPersonalInfo extends Model
{
    protected $casts = [
        'cv' => 'array',
        'team_members' => 'array'
    ];
}
