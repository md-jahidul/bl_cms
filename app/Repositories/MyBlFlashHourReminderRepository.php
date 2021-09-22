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
use App\Models\MyblFlashHourReminder;
use App\Models\Referee;
use Carbon\Carbon;

class MyBlFlashHourReminderRepository extends BaseRepository
{
    public $modelName = MyblFlashHourReminder::class;
}
