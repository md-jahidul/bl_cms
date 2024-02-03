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

            $availableProductsCacheByPackage = $customerAvailableProductsService->getAvailableProductsByCustomer();
            
            Log::info('Available Product cache By package update Success: Successfully Updated');
            return [
                'data' => $availableProductsCacheByPackage,
                'success' => true,
                'message' => 'Successfully done'
            ];

        } catch (\Exception $e) {
            Log::info('Available Product cache By package update Error:' . $e->getMessage());
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }
}