<?php

namespace App\Services\Feed;

use App\Models\FeedCategory;

/**
 * Class FeedCategory
 * @package App\Services\Feed
 */
class FeedCategoryService
{
    /**
     * @return mixed
     */
    public function getAll()
    {
        return FeedCategory::all();
    }
}
