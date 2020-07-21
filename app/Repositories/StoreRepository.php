<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\MyBlStore;

/**
 * Class StoreRepository
 * @package App\Repositories
 */
class StoreRepository extends BaseRepository
{
    public $modelName = MyBlStore::class;
}
