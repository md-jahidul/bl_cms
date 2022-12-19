<?php

namespace App\Jobs;

use App\Services\Assetlite\LeadRequestService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class LeadDataSend implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private $leadInfo;

    /**
     * Create a new job instance.
     *
     * @param $leadInfo
     */
    public function __construct($leadInfo)
    {
        $this->leadInfo = $leadInfo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $leadMailInfo = $this->leadInfo;
        LeadRequestService::sendMail($leadMailInfo);
    }
}
