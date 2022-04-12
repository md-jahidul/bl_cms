<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:56 PM
 */

namespace App\Services;

use App\Models\GuestCustomerActivity;
use App\Repositories\GuestCustomerActivityRepository;
use App\Traits\CrudTrait;
use Box\Spout\Common\Entity\Style\Color;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GuestUserTrackService
{
    use CrudTrait;

    /**
     * @var GuestCustomerActivityRepository
     */
    protected $guestCustomerActivityRepository;

    /**
     * GuestUserTrackService constructor.
     * @param GuestCustomerActivityRepository $guestCustomerActivityRepository
     */
    public function __construct(GuestCustomerActivityRepository $guestCustomerActivityRepository)
    {
        $this->guestCustomerActivityRepository = $guestCustomerActivityRepository;
        $this->setActionRepository($guestCustomerActivityRepository);
    }

    public function dataExportGenerator($request, $showData = null)
    {
        $builder = new GuestCustomerActivity();

        // dd('here');

        try {
            $result = DB::select("SELECT * from users  
            INTO OUTFILE '/var/lib/mysql-files/file224name.csv'     
            FIELDS TERMINATED BY ',' LINES TERMINATED BY '\r\n' ");
            // $result = DB::select("SHOW VARIABLES LIKE 'secure_file_priv'");
            dd($result);
        } catch (\Exception $e) {
            dd($e);
        }

        dd('here');

        

        if (isset($request->device_id)) {
            $builder = $builder->where('device_id', 'LIKE', "%$request->device_id%");
        }

        if (isset($request->platform)) {
            $builder = $builder->where('device_type', $request->platform);
        }

        if (isset($request->page_name)) {
            $builder = $builder->where('page_name', $request->page_name);
        }

        if (isset($request->msisdn)) {
            $builder = $builder->where('msisdn', $request->msisdn);
        }

        if (isset($request->msisdn_entry_type)) {
            $builder = $builder->where('msisdn_entry_type', $request->msisdn_entry_type);
        }

        if (isset($request->status)) {
            $builder = $builder->where('page_access_status', $request->status);
        }

        if (isset($request->date_range)) {
            $date = explode('➝', $request->date_range);
            $from = str_replace('/', '-', $date[0]) . " " . "00:00:00";
            $to = str_replace('/', '-', $date[1]) . " " . "23:59:59";
            $builder = $builder->whereBetween('created_at', [$from, $to]);
        }

        $builder = $builder->orderBy('created_at', 'DESC');

        if ($showData) {
            return $builder->take(50)->get();
        }

        $items = $builder->get();
        $this->generateFile($items, $request->export_type);
    }

    public function generateFile($items, $exportType)
    {
        $headerRow = [
            "Msisdn",
            "DeviceID",
            "Last Activity",
            "Platform",
            "Msisdn Entry Type",
            "Page",
            "Failed Reason",
            "Page Access Status",
            "Date & Time",
        ];

        $headerRowStyle = (new StyleBuilder())
            ->setFontBold()
            ->setFontSize(10)
            ->setBackgroundColor(Color::rgb(245, 245, 240))
            ->build();

        if ($exportType == "csv") {
            $writer = WriterEntityFactory::createCSVWriter();
        } else {
            $writer = WriterEntityFactory::createXLSXWriter();
        }

        $currentDateTime = Carbon::now()->setTimezone('Asia/Dhaka')->toDateTimeString();
        $writer->openToBrowser("Guest-User-Activities-" . str_replace(' ', '-', $currentDateTime) . ".$exportType");
        $row = WriterEntityFactory::createRowFromArray($headerRow, $headerRowStyle);
        $writer->addRow($row);

        $data_style = (new StyleBuilder())
            ->setFontSize(9)
            ->build();

        foreach ($items as $data) {
            $report = [
                'msisdn' => $data->msisdn,
                'device_id' => $data->device_id,
                'last_activity' => $data->last_activity,
                'device_type' => $data->device_type,
                'msisdn_entry_type' => str_replace('_', ' ', strtoupper($data->msisdn_entry_type)),
                'page_name' => str_replace('_', '-', $data->page_name),
                'failed_reason' => $data->failed_reason,
                'page_access_status' => ($data->page_access_status) ? "Success" : "Failed",
                'created_at' => $data->created_at
            ];

            $row = WriterEntityFactory::createRowFromArray($report, $data_style);
            $writer->addRow($row);
        }
        $writer->close();
    }
}
