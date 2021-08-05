<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\AboutPage;
use App\Models\MyblDynamicDeeplink;
use App\Models\Prize;

class MyblDynamicDeeplinkRepository extends BaseRepository
{
    public $modelName = MyblDynamicDeeplink::class;

    public function getAnalyticData()
    {
        return $this->model
            ->with('referenceable')
            ->get();
    }
}
