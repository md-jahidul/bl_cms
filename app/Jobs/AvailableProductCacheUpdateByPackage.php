<?php

namespace App\Jobs;

use App\Services\BlApiHub\CustomerAvailableProductsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AvailableProductCacheUpdateByPackage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    public $service;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $this->service = resolve(CustomerAvailableProductsService::class);
            $this->service->getAvailableProductsByPackage();

            Log::channel('available-product-cache-log')->info(
                'Available Product cache By package update from Job'
            );
        } catch (\Throwable $e) {
            Log::channel('available-product-cache-log')->error(
                'Available Product cache By package update Error from Job:' . $e->getMessage()
            );
        }
    }
}
