<?php

namespace App\Console\Commands;

use App\Repositories\GlobalSettingRepository;
use App\Services\GlobalSettingService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GlobalSettingScheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mybl:global-setting-scheduler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the start_time and end_time and unset a key from setting data object';

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
     *
     * @return mixed
     */
    public function handle(
        GlobalSettingService $globalSettingService
    )
    {
        try {

            $changeStatus = $globalSettingService->generateHashBasedOnDataCheck();

            if ($changeStatus) $globalSettingService->delGlobalSettingCache();

            Log::info('GlobalSettingsScheduler Success: Successfully check the start_time and end_time');
            return [
                'success' => true,
                'message' => 'Successfully done'
            ];

        } catch (\Exception $e) {
            Log::info('GlobalSettingsScheduler Error:' . $e->getMessage());
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }
}
