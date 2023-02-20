<?php

namespace App\Console\Commands;

use App\Services\NotifiationV2\CustomerDeviceSyncService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncCustomersAndCustomersDevicesTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mybl-table-sync:customers-and-customers_devices-table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync mysql customers with mysql customers_devices table';

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
    public function handle()
    {
        $customerDeviceSyncService = resolve(CustomerDeviceSyncService::class);
        $result = null;
        
        try {
            $result = $customerDeviceSyncService->freshSync();
            Log::info('Sync Success: Syncs mysql customers and customers_devices table');
        } catch (\Exception $e) {
            Log::info('Sync Error: ' . $e->getMessage());
        }
        
        dump($result);
    }
}
