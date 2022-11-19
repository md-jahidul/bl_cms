<?php


namespace App\Repositories;

use App\Models\FIFA\Match;
use App\Models\FIFA\Team;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MatchRepository extends BaseRepository
{
    public $modelName = Match::class;

}
