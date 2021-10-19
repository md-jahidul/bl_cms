<?php

namespace App\Repositories;

use App\Models\RedisResetSchedule;
use Carbon\Carbon;

class RedisResetScheduleRepository extends BaseRepository
{
   protected $modelName = RedisResetSchedule::class;

   public function getActiveSchedules()
   {
       return $this->model->where('status', 'active')->where('start_at', '<=', Carbon::now()->toDateTimeString())->get();
   }
}
