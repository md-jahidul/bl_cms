<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:07
 */

namespace App\Repositories;

use App\Models\AlSlider;
use App\Models\AppServiceCategory;
use App\Models\AppServiceProduct;
use App\Models\AppServiceProductDetail;

class AppServiceProductDetailsRepository extends BaseRepository
{
    public $modelName = AppServiceProductDetail::class;
}
