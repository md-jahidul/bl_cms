<?php

namespace App\Repositories;

use App\Models\MyBlFeed as Feed;

class FeedRepository extends BaseRepository
{
    protected $modelName = Feed::class;

    public function getFeeds()
    {
        return $this->model->orderBy('created_at', 'DESC')->get();
    }
}
