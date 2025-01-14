<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\MyblFlashHour;
use App\Models\MyblFlashHourProduct;
use App\Models\Referee;
use Carbon\Carbon;

class MyBlFlashHourProductRepository extends BaseRepository
{
    public $modelName = MyblFlashHourProduct::class;

    public function deleteProduct($productIds)
    {
        return $this->model->whereIn('id', $productIds)->delete();
    }
}
