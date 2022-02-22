<?php

namespace App\Console\Commands;

use App\Services\NotifiationV2\CustomerDeviceSyncService;
use Illuminate\Console\Command;

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
    protected $description = 'Command description';

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
        $customerDeviceSyncService->freshSync();
    }
}
