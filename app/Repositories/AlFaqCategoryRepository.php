<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:07
 */

namespace App\Repositories;

use App\Models\AlFaq;
use App\Models\AlFaqCategory;
use App\Models\Role;

class AlFaqCategoryRepository extends BaseRepository
{
    public $modelName = AlFaqCategory::class;
}
