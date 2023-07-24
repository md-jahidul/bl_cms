<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 26-Aug-19
 * Time: 4:34 PM
 */

namespace App\Repositories\BlLab;

use App\Models\BlLabIndustry;
use App\Repositories\BaseRepository;

class
BlLabProfessionRepository extends BaseRepository
{
    public $modelName = BlLabIndustry::class;
}
