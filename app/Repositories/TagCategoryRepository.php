<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 26-Aug-19
 * Time: 4:34 PM
 */

namespace App\Repositories;

use App\Models\Tag;
use App\Models\TagCategory;

class TagCategoryRepository extends BaseRepository
{
    public $modelName = TagCategory::class;
}
