<?php

namespace App\Console\Commands;

use App\Services\MyBlProductSchedulerService;
use App\Traits\FileTrait;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ProductDataScheduler extends Command
{
    use FileTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product-data:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Some content schedule for Product';

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
     * @param MyBlProductSchedulerService $myblProductScheduleService
     */
    public function handle(

        MyBlProductSchedulerService $myblProductScheduleService
    ) {
        try {
            $myblProductScheduleService->productSchedule();
            Log::info("Product Schedule Successfully Processed");
        } catch (\Exception $e) {
            Log::info("Error: ", $e->getMessage());
        }
    }

}
