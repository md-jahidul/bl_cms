<?php

namespace App\Models\FIFA;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable = ['home_team_id', 'away_team_id', 'start_time', 'ticketing_time', 'signed_cookie', 'url', 'status', 'is_hidden', 'number_of_seats'];

    public function homeTeam()
    {
        return $this->hasOne(Team::class, 'id', 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->hasOne(Team::class, 'id', 'away_team_id');
    }
}

