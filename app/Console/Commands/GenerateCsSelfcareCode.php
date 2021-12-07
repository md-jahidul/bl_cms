<?php

namespace App\Console\Commands;

use App\Models\CsSelfcareReferrer;
use App\Repositories\CsSelfcareReferrerRepository;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateCsSelfcareCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:cs-referral-code';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate CS selfcare code';

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
        $path = public_path('customers.xlsx');
        $reader = ReaderFactory::createFromType(Type::XLSX); // for XLSX files
        $reader->open($path);

        $insertData = [];

        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $row) {
                $value = $row->toArray();
                $agentMsisn = trim($value[0]);

                $referrerData = [];

                $referrerData['referrer'] = $agentMsisn;
                $referrerData['referral_code'] = $this->generateReferralCode($agentMsisn);
                $referrerData['start_date'] = Carbon::now()->toDateTimeString();


                if (config('constants.cs_selfcare.expired_after')) {
                    $referrerData['end_date'] = Carbon::now()->addDays(config('constants.cs_selfcare.expired_after'))->endOfDay()->toDateTimeString();
                }
                $insertData[] = $referrerData;
            }
        }

        foreach (array_chunk($insertData, 10) as $data) {
            $temp = [];
            foreach ($data as $index => $value) {
                $temp[] = $value;
            }
            CsSelfcareReferrer::insert($temp);
        }

        dd('completed');

    }

    /**
     * @param string $msisdn
     * @return string
     */
    private function generateReferralCode(string $msisdn): string
    {
        return str_shuffle(config('constants.cs_selfcare.referral_code_prefix') . strtoupper(dechex($msisdn)));
    }
}
