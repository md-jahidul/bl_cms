<?php

namespace App\Services;

use App\Repositories\RedisResetScheduleRepository;
use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RedisResetScheduleService
{
    use CrudTrait;
    /**
     * @var RedisResetScheduleRepository
     */
    private $redisResetScheduleRepository;

    /**
     * RedisResetScheduleService constructor.
     * @param RedisResetScheduleRepository $redisResetScheduleRepository
     */
    public function __construct(RedisResetScheduleRepository $redisResetScheduleRepository)
    {
        $this->redisResetScheduleRepository = $redisResetScheduleRepository;
        $this->setActionRepository($redisResetScheduleRepository);
    }

    public function storeData(array $data)
    {
        if (!in_array($data['redis_key_to_reset'], config('constants.redis-keys'))) {
            return false;
        }
        $data['created_by'] = Auth::user()->id;
        $data['start_at'] = Carbon::createFromFormat('Y/m/d H:i', $data['start_at'])->toDateTimeString();
        return $this->save($data);
    }

    public function updateData($id, array $data)
    {
        if (!in_array($data['redis_key_to_reset'], config('constants.redis-keys'))) {
            return false;
        }
        $data['start_at'] = Carbon::createFromFormat('Y/m/d H:i', $data['start_at'])->toDateTimeString();
        return $this->findOne($id)->update($data);
    }

    public function toggleStatus($id)
    {
        $schedule = $this->findOne($id);
        return $schedule->update(['status' => ($schedule->status === 'active') ? 'inactive' : 'active']);
    }
}
