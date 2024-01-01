<?php


namespace App\Repositories;


use App\Models\GenericRail;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GenericRailRepository extends BaseRepository
{
    public $modelName = GenericRail::class;
}
