<?php

namespace App\Console\Commands;

use App\Models\MyBlProduct;
use App\Models\ProductCore;
use App\Services\NotifiationV2\CustomerDeviceSyncService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncMyBlProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mybl:sync_customer_device_token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Customer Device Token';

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

        $allCustomersAndMsisdns = $customerDeviceSyncService->getCustomersDevices();

        try 
        {
            $customerDeviceSyncService->pushCustomersDevicesTable($allCustomersAndMsisdns);

            Log::info('Success: Customer');
        } 
        
        catch (\Exception $e) 
        {
            Log::info('Error:' . $e->getMessage());
        }
    }
}
