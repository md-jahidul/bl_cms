<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\AboutPage;
use App\Models\Prize;
use App\Models\StoreLocator;

class StoreLocatorRepository extends BaseRepository
{
    public $modelName = StoreLocator::class;

    public function deleteStoreLocator()
    {
        $this->model->truncate();
    }
}
