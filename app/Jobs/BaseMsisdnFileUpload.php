<?php

namespace App\Jobs;

use App\Models\BaseMsisdn;
use App\Models\BaseMsisdnFile;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;


class BaseMsisdnFileUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $insertData, $sheet, $filePath;
    private $baseFileData, $baseFileInfo;

    public $timeout = 1800;
    public $retryAfter = 1860;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($filePath, $baseFileData, $baseFileInfo)
    {
       $this->filePath      = $filePath;
       $this->baseFileData  = $baseFileData;
       $this->baseFileInfo  = $baseFileInfo;
    }

    /**
     * Execute the job.
     *
     * @return array
     */
    public function handle()
    {
        $reader = ReaderFactory::createFromFile($this->filePath); // for XLSX and CSV files
        $reader->open($this->filePath);
        $insertData = array();
        foreach ($reader->getSheetIterator() as $sheet) {
            $cnt=0;
            foreach ($sheet->getRowIterator() as $rowNum => $row) {
                $cells = $row->getCells();
                $msisdn = trim($cells[0]->getValue());
                ++$cnt;
                $insertData[] = "0" . substr($msisdn, -10);
                if($cnt%3000==0){
                    foreach (array_chunk($insertData, 1000) as $smallerArray) {
                        foreach ($smallerArray as $index => $value) {
                            $temp[$index] = [
                                'group_id' => $this->baseFileData['base_msisdn_group_id'],
                                'base_msisdn_file_id' => $this->baseFileInfo->id,
                                'msisdn' => $value,
                                'created_at'   => Carbon::now()->toDateTimeString(),
                            ];
                        }
                        BaseMsisdn::insert($temp);
                    }
                    $cnt=0;
                    $insertData = [];
                }
            }
            $temp = array();
            foreach ($insertData as $value) {
                    $temp[] = [
                        'group_id' => $this->baseFileData['base_msisdn_group_id'],
                        'base_msisdn_file_id' => $this->baseFileInfo->id,
                        'msisdn' => $value,
                        'created_at'   => Carbon::now()->toDateTimeString(),
                    ];
            }
            BaseMsisdn::insert($temp);
        }

        Redis::set('categories-sync-with-product'. $this->baseFileInfo->base_msisdn_group_id, 2);
    }
}
