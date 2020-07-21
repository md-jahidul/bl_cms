<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\MyBlStore;

/**
 * Class StoreAppRepository
 * @package App\Repositories
 */
class StoreAppRepository extends BaseRepository
{
    public $modelName = MyBlStore::class;

}
