<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\AboutPage;
use App\Models\MyblUsimEligibilityContent;
use App\Models\Prize;

class MyblUsimEligibilityRepository extends BaseRepository
{
    public $modelName = MyblUsimEligibilityContent::class;

    public function getData()
    {
        return $this->model->first();
    }
}
