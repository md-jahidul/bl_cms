<?php

namespace App\Repositories;

use App\Models\MyBlFeed as Feed;
use Carbon\Carbon;

class FeedRepository extends BaseRepository
{
    protected $modelName = Feed::class;
}
