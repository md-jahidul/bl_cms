<?php

namespace App\Console\Commands;

use App\Models\MyBlProduct;
use App\Models\ProductCore;
use App\Services\NotifiationV2\CustomerDeviceSyncService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncMongoDbCustomersDevicesTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mybl-table-sync:mongodb-customers_devices-table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Customer Device Table With MongoDB';

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
        $result = null ;
        
        try {
            $result = $customerDeviceSyncService->pushCustomersDevicesTable($allCustomersAndMsisdns);
            Log::info('Sync Success: MongoDb customers_devices table');
        } catch (\Exception $e) 
        {
            Log::info('Sync Error:' . $e->getMessage());
        }

        dump($result);
    }
}
