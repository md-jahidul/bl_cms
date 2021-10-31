<?php

namespace App\Console\Commands;

use App\Mail\SendRafmReportCsSelfcare;
use App\Models\CsSelfcareReferee;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

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
     * @return mixed
     */
    public function handle()
    {
        $csSelfcareData = CsSelfcareReferee::get();
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
            $data[2] = $csSelfcareDatum->referrer_msisdn;
            $data[3] = $csSelfcareDatum->referee_msisdn;
            $data[4] = $csSelfcareDatum->referee_msisdn;
            $data[5] = 'referee';
            $data[6] = $csSelfcareDatum->is_redeemed ? 'Success' : 'Failed';
            $data[7] = '';
            $data[8] = '';
            $row = WriterEntityFactory::createRowFromArray($data);
            $writer->addRow($row);
        }

        $writer->close();

        $gzipPath = $this->gzCompressFile($fileName);

        if ($gzipPath) {
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
}
