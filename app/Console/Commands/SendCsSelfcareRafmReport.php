<?php

namespace App\Console\Commands;

use App\Mail\SendRafmReportCsSelfcare;
use App\Models\CsSelfcareReferee;
use App\Repositories\CustomerRepository;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SendCsSelfcareRafmReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:cs-sefcare-rafm-report';

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
     * @param CustomerRepository $customerRepository
     * @return mixed
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    public function handle(CustomerRepository $customerRepository)
    {
        $csSelfcareData = CsSelfcareReferee::where('is_redeemed', 1)->whereDate('created_at', Carbon::today())->get();
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
            'Volume Disbursement',
            'IDENTIFIER'
        ]);
        $writer->openToFile(storage_path('app/public/cs/') . $fileName . '.csv');
        $writer->addRow($row);

        $data = [];
        foreach ($csSelfcareData as $csSelfcareDatum) {
            $data[0] = Carbon::parse($csSelfcareDatum->created_at)->toDateTimeString();
            $data[1] = Carbon::parse($csSelfcareDatum->created_at)->toDateString();
            $data[2] = data_get($csSelfcareDatum, 'referrer_msisdn','');;
            $data[3] = $csSelfcareDatum->referee_msisdn;
            $data[4] = $csSelfcareDatum->referee_msisdn;
            $data[5] = 'referee';
            $data[6] = $csSelfcareDatum->is_redeemed ? 'Success' : 'Failed';
            $data[7] = $this->getCustomerInfo($customerRepository, $csSelfcareDatum->referee_msisdn) ? $this->getCustomerInfo($customerRepository, $csSelfcareDatum->referee_msisdn)->created_at : '';
            $data[8] = $this->getCustomerInfo($customerRepository, $csSelfcareDatum->referee_msisdn) ? strtolower($this->getCustomerInfo($customerRepository, $csSelfcareDatum->referee_msisdn)->number_type) == 'prepaid' ? config('constants.cs_selfcare.cs_referral_product_code_prepaid') : config('constants.cs_selfcare.cs_referral_product_code_postpaid') : '';
            $data[9] = $this->getCustomerInfo($customerRepository, $csSelfcareDatum->referee_msisdn) ? strtolower($this->getCustomerInfo($customerRepository, $csSelfcareDatum->referee_msisdn)->number_type) == 'prepaid' ? config('constants.cs_selfcare.cs_referral_product_code_prepaid') : config('constants.cs_selfcare.cs_referral_product_code_postpaid') : '';

            $row = WriterEntityFactory::createRowFromArray($data);
            $writer->addRow($row);
            $data = [];
        }

        $writer->close();

        $gzipPath = $this->gzCompressFile($fileName);
        $fileExistance = Storage::disk('cs-selfcare')->exists($fileName . '.csv.gz');
        if ($gzipPath && $fileExistance) {
            $file = Storage::disk('cs-selfcare')->get($fileName . '.csv.gz');
            $sendFile = Storage::disk('sftp')->put('',$file);
            Mail::to(config('constants.cs_selfcare.rafm_report_mail'))->send(new SendRafmReportCsSelfcare($fileName));
        }
        dd('completed');
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
