<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 26-Aug-19
 * Time: 4:34 PM
 */

namespace App\Repositories\BlLab;

use App\Models\BlLab\BlLabApplication;
use App\Repositories\BaseRepository;

class
BlLabApplicationRepository extends BaseRepository
{
    public $modelName = BlLabApplication::class;
}