<?php

namespace App\Jobs;

use App\Models\FreeProductDisburse;
use App\Services\Banglalink\LeadRequestService;
use App\Services\FreeProductDisburseService;
use App\Services\PushNotificationService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class FreeProductDisburseJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private $fileId;


    public function __construct($fileId)
    {
        $this->fileId = $fileId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $freeProductDisburseData = FreeProductDisburse::where('file_id', $this->fileId)->where('is_disburse', 0)->get();
//        Log::info(json_encode($freeProductDisburseData));
        $freeProductDisburseService = resolve(FreeProductDisburseService::class);

        foreach ($freeProductDisburseData as $data) {
            $param['msisdn'] = $data->msisdn;
            $param['id'] = $data->product_code;

            $flag = $freeProductDisburseService->productPurchase($param);
//            Log::info('flag = ' . $flag);
            if ($flag) {
                $userData = FreeProductDisburse::where('id', $data->id)->first();
                $userData->update(['is_disburse' => 1]);
            }
        }
    }
}
