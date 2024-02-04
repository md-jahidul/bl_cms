<?php

namespace App\Console\Commands;

use App\Services\BlApiHub\CustomerAvailableProductsService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AvailableProductCacheByPackage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mybl:available-product-cache-by-package-scheduler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache Available Product By package in redis from APIHub';

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
        CustomerAvailableProductsService $customerAvailableProductsService
    ) {
        try {
            $customerAvailableProductsService->getAvailableProductsByPackage();

            Log::channel('available-product-cache-log')->info(
                'Available Product cache By package update: Successfully Updated'
            );
        } catch (\Exception $e) {
            Log::channel('available-product-cache-log')->error(
                'Available Product cache By package update Error:' . $e->getMessage()
            );
        }
    }
}