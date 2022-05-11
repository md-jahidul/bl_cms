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

   private $insertData, $sheet, $filePath;
   private $baseFileData, $baseFileInfo;

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
        foreach ($reader->getSheetIterator() as $sheet) {
            $cnt=0;
            $insertData = array();
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
                                'msisdn' => $value
                            ];
                        }
                        BaseMsisdn::insert($temp);
                    }
                    $cnt=0;
                    $insertData = [];
                }
            }
            foreach (array_chunk($insertData, 1000) as $smallerArray) {
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
}
