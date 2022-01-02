<?php

namespace App\Console\Commands;

use App\Models\CsSelfcareReferee;
use App\Repositories\CustomerRepository;
use App\Services\ProductService;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SendRafmReportCsSelfcare extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:rafm-report-cs-sefcare';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send cs self-care rafm report to banglalink';

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
    public function handle(CustomerRepository $customerRepository, ProductService $productService)
    {
        $redeems = CsSelfcareReferee::with('referrer')->where('is_redeemed', 1)->whereDate('created_at',
            Carbon::yesterday()->setTimezone('Asia/Dhaka'))->get();

        $fileName = 'Reffer_n_Promote_RAFM_Report_' . date_format(Carbon::now(), 'YmdHis');

        $writer = WriterEntityFactory::createCSVWriter();
        $row = WriterEntityFactory::createRowFromArray([
            'Time',
            'Date',
            'Referral Number',
            'Referee Number',
            'Bonus Got Number',
            'Bonus Type',
            'Transaction Status',
            'Referee Signup',
            'Volume Disbursement (MB)',
            'IDENTIFIER',
            'Referral code',
            'Campaign Type',
        ]);
        $writer->openToFile(storage_path('app/public/cs/') . $fileName . '.csv');
        $writer->addRow($row);

        $data = [];

        foreach ($redeems as $redeem){
            $data[0] = Carbon::parse($redeem->redeemed_at)->setTimezone('Asia/Dhaka')->toDateTimeString();
            $data[1] = Carbon::parse($redeem->redeemed_at)->setTimezone('Asia/Dhaka')->toDateString();
            $data[2] = data_get($redeem->referrer, 'referrer', '');
            $data[3] = $redeem->referee_msisdn;
            $data[4] = $redeem->referee_msisdn;
            $data[5] = 'referee';
            $data[6] = $redeem->is_redeemed ? 'Success' : 'Failed';
            $data[7] = $this->getCustomerInfo($customerRepository,
                $redeem->referee_msisdn) ? Carbon::parse($this->getCustomerInfo($customerRepository,
                $redeem->referee_msisdn)->created_at)->setTimezone('Asia/Dhaka')->toDateTimeString() : '';
            $data[8] = $this->getCustomerInfo($customerRepository,
                $redeem->referee_msisdn) ? strtolower($this->getCustomerInfo($customerRepository,
                $redeem->referee_msisdn)->number_type) == 'prepaid' ? $productService->getInternetVolumeByProductCode(config('constants.cs_selfcare.cs_referral_product_code_prepaid')) : $productService->getInternetVolumeByProductCode(config('constants.cs_selfcare.cs_referral_product_code_postpaid')) : '';
            $data[9] = $this->getCustomerInfo($customerRepository,
                $redeem->referee_msisdn) ? strtolower($this->getCustomerInfo($customerRepository,
                $redeem->referee_msisdn)->number_type) == 'prepaid' ? config('constants.cs_selfcare.cs_referral_product_code_prepaid') : config('constants.cs_selfcare.cs_referral_product_code_postpaid') : '';

            $data[10] = data_get($redeem->referrer, 'referral_code', '');
            $data[11] = data_get($redeem->referrer, 'code_type', '');
            $row = WriterEntityFactory::createRowFromArray($data);
            $writer->addRow($row);
            $data = [];
        }

        $writer->close();

        $gzipPath = $this->gzCompressFile($fileName);
        try {
            $file = Storage::disk('cs-selfcare');
            if ($gzipPath && $file->exists($fileName . '.csv.gz')) {
                $localFile = $file->get($fileName . '.csv.gz');
                $sendFile = Storage::disk('sftp')->put($fileName . '.csv.gz', $localFile);
            }
        } catch (\Exception $exception) {
            Log::error('CS_SELFCARE_RAFM_ERROR: ' . $exception->getMessage());
        }

    }

    public function gzCompressFile($fileName, $level = 9)
    {
        $source = storage_path('app/public/cs/') . $fileName . '.csv';
        $destination = $source . '.gz';
        $mode = 'wb' . $level;
        $error = false;

        if ($fp_out = gzopen($destination, $mode)) {
            if ($fp_in = fopen($source, 'rb')) {
                while (!feof($fp_in)) {
                    gzwrite($fp_out, fread($fp_in, 1024 * 512));
                }
                fclose($fp_in);
            } else {
                $error = true;
            }
            gzclose($fp_out);
        } else {
            $error = true;
        }
        if ($error) {
            return false;
        } else {
            return $destination;
        }
    }


    public function getCustomerInfo($customerRepository, $msisdn)
    {
        return $customerRepository->getCustomerInfo($msisdn);
    }
}
