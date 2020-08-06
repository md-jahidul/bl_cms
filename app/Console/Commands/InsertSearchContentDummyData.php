<?php

namespace App\Console\Commands;

use App\Models\MyBlSearchContent;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Illuminate\Console\Command;

/**
 * Class InsertSearchContentDummyData
 * @package App\Console\Commands
 */
class InsertSearchContentDummyData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search-content:insert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dummy Data Insert For Search Content';

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
    public function handle()
    {
        try {
            $reader = ReaderFactory::createFromType(Type::XLSX); // for XLSX files
            $path = $this->ask('Enter your File Path');
            $chunk_size = $this->ask('Enter Chunk Size');
            //$path = '/var/www/projects/bl_idp/public/Customer_data_without_password.csv';
            $reader->open($path);

            foreach ($reader->getSheetIterator() as $sheet) {
                $this->info('Start Reading');
                $rowNumber = 1;
                $index = 0;
                $insertdata = [];
                $batch = 1;
                foreach ($sheet->getRowIterator() as $row) {
                    $cells = $row->getCells();
                    if ($rowNumber > 1) {
                        //dd($cells[4]);
                        $search_content = explode(',', $cells[2]->getValue());
                        $other_info     = ($cells[4]->getValue() != "") ? explode(',', $cells[4]->getValue()) : [];

                        $other_contents = [];

                        if (!empty($other_info)) {
                            foreach ($other_info as $info) {
                                $values = explode('-', $info);
                                $other_contents[$values[0]] = $values[1];
                            }
                        }

                        $insertdata[] = [
                            'display_title'     => $cells[0]->getValue(),
                            'description'       => $cells[1]->getValue(),
                            'search_content'   => implode(', ', $search_content),
                            'navigation_action' => $cells[3]->getValue(),
                            'other_contents'    => (!empty($other_contents)) ? json_encode($other_contents) : null,
                            'connection_type'   =>  $cells[5]->getValue(),
                        ];

                        //dd($insertdata);
                    }
                    $index++;
                    $rowNumber++;

                    if (count($insertdata) == $chunk_size) {
                        $this->info('Inserting...');

                        MyBlSearchContent::insert($insertdata);
                        $this->info("Batch #$batch Inserted");
                        $batch++;
                        $insertdata = [];
                    }
                }
            }

            if (!empty($insertdata)) {
                MyBlSearchContent::insert($insertdata);
                $this->info("Batch #$batch Inserted");
            }

            $this->info('Completed');
        } catch (\Exception $e) {
            //dd($e);
            $this->info($e->getMessage());
        }
    }
}
