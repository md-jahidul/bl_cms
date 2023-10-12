<?php

namespace App\Repositories\Page;

use App\Models\Page\NewPageComponent;
use App\Repositories\BaseRepository;

class PgComponentRepository extends BaseRepository
{
    public $modelName = NewPageComponent::class;
}
