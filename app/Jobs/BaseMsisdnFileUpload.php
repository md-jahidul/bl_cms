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

//    private $baseFileData;
//    private $reader;
//    private $baseFileInfo;
    private $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
//        $this->reader = $reader;
//        $this->baseFileData = $baseGroupId;
//        $this->baseFileInfo = $baseFileInfo;
    }

    /**
     * Execute the job.
     *
     * @return array
     */
    public function handle()
    {
//        $reader = $this->reader;
//        $action = $this->action;
//        $baseFileData = $this->baseFileData;
//        $baseFileInfo = $this->baseFileInfo;

//        $insertData = array();
//
//        Log::error("Failed: $insertData");
//        foreach ($this->reader->getSheetIterator() as $sheet) {
//            foreach ($sheet->getRowIterator() as $key => $row) {
//                $cells = $row->getCells();
//                $msisdn = trim($cells[0]->getValue());
//
//                Log::error("Failed: $msisdn");
//
//                if (strlen($msisdn) < 10) {
//                    return [
//                        'status' => false,
//                        'message' => 'Upload Failed! Wrong msisdn at row: ' . $key
//                    ];
//                }
//                $insertData[] = "0" . substr($msisdn, -10);
//            }
//        }
//
//        foreach (array_chunk($insertData, 800) as $smallerArray) {
//            foreach ($smallerArray as $index => $value) {
//                $temp[$index] = [
//                    'group_id' => $this->baseFileData,
//                    'base_msisdn_file_id' => $this->baseFileInfo->id,
//                    'msisdn' => $value
//                ];
//            }
//            BaseMsisdn::insert($temp);
////            BaseMsisdnFileUpload::dispatch($reader, $baseFileInfo, $baseFileData);
//        }

        BaseMsisdn::insert($this->data);
    }
}
