<?php

namespace App\Jobs;

use App\Http\Resources\NotificationListCollection;
use App\Models\NotificationUser;
use App\Repositories\CustomerRepository;
use App\Repositories\NotificationRepository;
use App\Services\NotificationService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class TestJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     *
     * @param NotificationListCollection $notifications
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        sleep(20);
        Log::info(__CLASS__ . " Job From TEST JOB");
    }
}
