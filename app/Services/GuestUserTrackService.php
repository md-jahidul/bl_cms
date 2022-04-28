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
use App\Traits\FileTrait;
use Box\Spout\Common\Entity\Style\Color;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Carbon\Carbon;
use Illuminate\Http\File;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class GuestUserTrackService
{
    use CrudTrait;
    use FileTrait;

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
//        dd($request->all());
        $rawQuery = 'SELECT * FROM guest_customer_activities WHERE';
        if (isset($request->device_id)) {
            $rawQuery .= " AND device_id LIKE " . '"%' . $request->device_id . '%"';
        }
        if (isset($request->platform)) {
            $rawQuery .= ' AND device_type = ' . '"' . $request->platform . '"';
        }
        if (isset($request->page_name)) {
            $rawQuery .= " AND page_name LIKE " . '"%' . $request->page_name . '%"';
        }
        if (isset($request->msisdn)) {
            $rawQuery .= ' AND msisdn = ' . '"' . $request->msisdn . '"';
        }
        if (isset($request->msisdn_entry_type)) {
//            $rawQuery .= $arrayCount > 3 ? " AND" : "";
            $rawQuery .= ' msisdn_entry_type = ' . '"' . $request->msisdn_entry_type . '"';
        }
        if (isset($request->status)) {
//            $rawQuery .= $arrayCount > 3 ? " AND" : "";
            $rawQuery .= " AND page_access_status = $request->status";
        }

        if (isset($request->date_range)) {
            $date = explode('➝', $request->date_range);
            $from = str_replace('/', '-', $date[0]) . " " . "00:00:00";
            $to = str_replace('/', '-', $date[1]) . " " . "23:59:59";
//            $rawQuery .= $arrayCount > 3 ? " AND" : "";
            $rawQuery .= " AND created_at BETWEEN " . "'" . $from . "'" . ' AND ' . "'" . $to . "'";
        }

        $rawQuery .= " ORDER BY created_at DESC";

        if (!isset($request->export_type)) {
            $rawQuery .= " LIMIT 50;";
        }

        $rawQueryFiltered = str_replace("WHERE AND", 'WHERE', $rawQuery);

        if (isset($request->export_type)) {
            $dbUser = env('DB_USERNAME');
            $dbPPassword = env('DB_PASSWORD');
            $dbName = env('DB_DATABASE');
            $logUploadPath = env('GUEST_USER_LOG_FILE', "");
            $fileName = "guest_user.csv";

            $cmd = 'mysql -e ' . '"' . $rawQueryFiltered . '"' . ' -u ' . $dbUser . ' -p' . $dbPPassword . ' ' . $dbName . ' > ' . $logUploadPath . $fileName;
            exec($cmd);

            //FIle full path
            $file = $logUploadPath . $fileName;
            $headers = array(
                'Content-Type: application/csv',
            );
            return Response::download($file, $fileName, $headers);
        }


//        $builder = new GuestCustomerActivity();
//
//        if (isset($request->device_id)) {
//            $builder = $builder->where('device_id', 'LIKE', "%$request->device_id%");
//        }
//
//        if (isset($request->platform)) {
//            $builder = $builder->where('device_type', $request->platform);
//        }
//
//        if (isset($request->page_name)) {
//            $builder = $builder->where('page_name', 'like', "%$request->page_name%");
//        }
//
//        if (isset($request->msisdn)) {
//            $builder = $builder->where('msisdn', $request->msisdn);
//        }
//
//        if (isset($request->msisdn_entry_type)) {
//            $builder = $builder->where('msisdn_entry_type', $request->msisdn_entry_type);
//        }
//
//        if (isset($request->status)) {
//            $builder = $builder->where('page_access_status', $request->status);
//        }
//
//        if (isset($request->date_range)) {
//            $date = explode('➝', $request->date_range);
//            $from = str_replace('/', '-', $date[0]) . " " . "00:00:00";
//            $to = str_replace('/', '-', $date[1]) . " " . "23:59:59";
//            $builder = $builder->whereBetween('created_at', [$from, $to]);
//        }
//
//        $builder = $builder->orderBy('created_at', 'DESC');
//        dd($rawQueryFiltered);
        $guestUserActivity = DB::select(DB::raw($rawQueryFiltered));
        $guestUserActivity = json_decode(json_encode($guestUserActivity), true);

        if ($showData) {
            if (count($guestUserActivity) > 0) {
                return [
                    'success' => true,
                    'data' => $guestUserActivity,
                    'massage' => "Data found!!"
                ];
            } else {
                return [
                    'success' => false,
                    'data' => [],
                    'massage' => "Data not found!!"
                ];
            }
        }

//        $items = $builder->get();


//        $this->generateFile($items, $request->export_type);
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
