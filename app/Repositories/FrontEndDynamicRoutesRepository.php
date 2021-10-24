<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\AboutPage;
use App\Models\FrontEndDynamicRoute;
use App\Models\Prize;

class FrontEndDynamicRoutesRepository extends BaseRepository
{
    public $modelName = FrontEndDynamicRoute::class;
}
