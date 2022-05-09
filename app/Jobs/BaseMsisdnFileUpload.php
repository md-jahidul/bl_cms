<?php

namespace App\Jobs;

use App\Models\BaseMsisdn;
use App\Models\BaseMsisdnFile;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BaseMsisdnFileUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

   private $insertData;
   private $baseFileData, $baseFileInfo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($insertData, $baseFileData, $baseFileInfo)
    {
       $this->insertData = $insertData;
       $this->baseFileData = $baseFileData;
       $this->baseFileInfo = $baseFileInfo;
    }

    /**
     * Execute the job.
     *
     * @return array
     */
    public function handle()
    {
        foreach (array_chunk($this->insertData, 1000) as $smallerArray) {
            foreach ($smallerArray as $index => $value) {
                $temp[$index] = [
                    'group_id' => $this->baseFileData['base_msisdn_group_id'],
                    'base_msisdn_file_id' => $this->baseFileInfo->id,
                    'msisdn' => $value
                ];
            }
            BaseMsisdn::insert($temp);
        }
    }
}
