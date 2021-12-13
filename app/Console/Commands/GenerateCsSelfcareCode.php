<?php

namespace App\Console\Commands;

use App\Models\CsSelfcareReferrer;
use App\Repositories\CsSelfcareReferrerRepository;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GenerateCsSelfcareCode extends Command
{
    const CODE_TYPE_RETAILER = 'retailer';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:cs-referral-code {fileName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate CS selfcare upsell code';

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
    public function handle(CsSelfcareReferrerRepository $csSelfcareReferrerRepository)
    {
        $fileName = $this->argument('fileName');
        $path = public_path($fileName);

        // Code insertion into DB
        $this->insertCodeIntoDB($path, $csSelfcareReferrerRepository);
        // Generating CSV with Codes
        $this->generateCsvWithCodes($fileName);
        print "CSV with retailer and code in storage/app/public/cs/Retailer Folder, Filename:" . "Codes_" . $fileName . "\n";
    }

    /**
     * @param string $msisdn
     * @return string
     */
    private function generateReferralCode(string $msisdn): string
    {
        return str_shuffle(config('constants.cs_selfcare.referral_code_prefix') . strtoupper(dechex($msisdn)));
    }

    public function generateCsvWithCodes($fileName)
    {
        $retailerCodes = CsSelfcareReferrer::where('code_type', self::CODE_TYPE_RETAILER)->get();
        $fileNameWithCodes = "Codes_" . $fileName;

        $writer = WriterEntityFactory::createCSVWriter();
        $row = WriterEntityFactory::createRowFromArray([
            'Retailer MSISDN',
            'Referral Code',
            'Code Generation Date',
        ]);

        $writer->openToFile(storage_path('app/public/cs/Retailer/') . $fileNameWithCodes);
        $writer->addRow($row);

        $data = [];

        foreach ($retailerCodes->chunk(1000) as $chunk) {
            foreach ($chunk as $code) {
                $data[0] = $code->referrer;
                $data[1] = $code->referral_code;
                $data[2] = $code->created_at;

                $row = WriterEntityFactory::createRowFromArray($data);
                $writer->addRow($row);
                $data = [];
            }
        }

        $writer->close();

        return true;
    }

    public function insertCodeIntoDB($path, $csSelfcareReferrerRepository)
    {
        try {
            $reader = ReaderFactory::createFromType(Type::CSV); // for CSV files
            $reader->open($path);

            $insertData = [];

            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $row) {
                    $value = $row->toArray();
                    $agentMsisn = trim($value[0]);

                    $isAlreadyExists = $csSelfcareReferrerRepository->checkRecord($agentMsisn);

                    if ($isAlreadyExists) {
                        Log::channel('retailerLog')->info('Retailer Exists: ' . '0' . $agentMsisn);
                        continue;
                    }

                    $referrerData = [];

                    $referrerData['referrer'] = "0" . substr($agentMsisn, -10);
                    $referrerData['code_type'] = self::CODE_TYPE_RETAILER;
                    $referrerData['referral_code'] = $this->generateReferralCode($agentMsisn);
                    $referrerData['start_date'] = Carbon::now()->toDateTimeString();
                    $referrerData['created_at'] = Carbon::now()->toDateTimeString();
                    $referrerData['updated_at'] = Carbon::now()->toDateTimeString();

                    if (config('constants.cs_selfcare.expired_after')) {
                        $referrerData['end_date'] = Carbon::now()->addDays(config('constants.cs_selfcare.expired_after') - 1)->startOfDay()->toDateTimeString();
                    }
                    $insertData[] = $referrerData;
                }
            }

            foreach (array_chunk($insertData, 1000) as $data) {
                $temp = [];
                foreach ($data as $value) {
                    $temp[] = $value;
                }
                CsSelfcareReferrer::insert($temp);
            }

            return true;
        } catch (\Exception $exception) {
            Log::info('Retailer_Code_Insertion_Error:' . $exception->getMessage());
        }

    }
}
