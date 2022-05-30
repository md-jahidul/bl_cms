<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class GuestUserDataDownload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Redis::set("guest_user_file_generate_status", 0);

        $guestUserActivity = DB::select($this->data);
        $guestUserActivity = json_decode(json_encode($guestUserActivity), true);
        $logUploadPath = env('GUEST_USER_LOG_FILE', "");
        $fileName = "guest_user.csv";
        $fullPath = $logUploadPath . $fileName;
        $headers = [
            [
                "MSISDN",
                "DEVICE ID",
                "LAST ACTIVITY",
                "LAST LOGIN AT",
                "PLATFORM",
                "MSISDN ENTRY TYPE",
                "PAGE NAME",
                "FAILED REASON",
                "PAGE ACCESS STATUS",
                "DATE TIME"
            ],
        ];
        $data = array_merge($headers, $guestUserActivity);
        $handle = fopen($fullPath, 'w');
        foreach ($data as $row) {
            fputcsv($handle, json_decode(json_encode($row), true));
        }
        fclose($handle);

//        Redis::del("guest_user_file_generate_status");
//        Redis::set("guest_user_file_generate_status", 1);
    }
}
