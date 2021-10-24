<?php

namespace App\Console\Commands;

use App\Repositories\RedisResetScheduleRepository;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class RedisResetScheduler extends Command
{

    protected $signature = 'redis-reset:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Executes a scheduled reset in redis db';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * @param RedisResetScheduleRepository $redisResetScheduleRepository
     */
    public function handle(RedisResetScheduleRepository $redisResetScheduleRepository)
    {
        try {
            $schedules = $redisResetScheduleRepository->getActiveSchedules();
            if ($schedules->count()) {
                $pattern = Str::slug(env('REDIS_PREFIX', 'laravel'), '_') . '_database_';
                foreach ($schedules as $schedule) {
                    $keys = Redis::keys( $schedule->redis_key_to_reset . ':*');
                    $values = [];
                    foreach ($keys as $key) {
                        $values [] = str_replace($pattern, '', $key);
                    }

                    if (!empty($values)) {
                        Redis::del($values);
                        $schedule->update(['status' => 'completed']);
                        Log::info('Redis key for ' . $schedule->redis_key_to_reset .' has been reset at:' . Carbon::now()->toDateTimeString() .
                            ' by user id : ' . Auth::id() . '. Total no of deleted key = ' . count($keys)
                        );
                    }
                }
            }
            
        } catch (\Exception $exception) {
            Log::error('Error while scheduled resetting redis key. Reason:' . $exception->getMessage());
        }
    }

}
