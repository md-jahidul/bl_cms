<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:56 PM
 */

namespace App\Services;

use App\Jobs\GuestUserDataDownload;
use App\Repositories\GuestCustomerActivityRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

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
        $rawQuery = 'SELECT msisdn,device_id,last_activity,last_login_at,device_type,
                           msisdn_entry_type,page_name,failed_reason,page_access_status,created_at
                     FROM guest_customer_activities WHERE';
        if (isset($request->device_id)) {
            $rawQuery .= " AND device_id LIKE " . "'%" . $request->device_id . "%'";
        }
        if (isset($request->platform)) {
            $rawQuery .= ' AND device_type = ' . "'" . $request->platform . "'";
        }
        if (isset($request->page_name)) {
            $rawQuery .= " AND page_name LIKE " . "'%" . $request->page_name . "%'";
        }
        if (isset($request->msisdn)) {
            $rawQuery .= ' AND msisdn = ' . "'" . $request->msisdn . "'";
        }
        if (isset($request->msisdn_entry_type)) {
            $rawQuery .= ' AND msisdn_entry_type = ' . "'" . $request->msisdn_entry_type . "'";
        }
        if (isset($request->status)) {
            $rawQuery .= " AND page_access_status = $request->status";
        }
        if (isset($request->user_activity_type)) {
            $rawQuery .= " AND login_status = $request->user_activity_type";
        }

        if (isset($request->date_range)) {
            $date = explode('➝', $request->date_range);
            $from = str_replace('/', '-', $date[0]) . " " . "00:00:00";
            $to = str_replace('/', '-', $date[1]) . " " . "23:59:59";
            $rawQuery .= " AND created_at BETWEEN " . "'" . $from . "'" . ' AND ' . "'" . $to . "'";
        }

        $rawQuery .= " ORDER BY created_at DESC";

        if (!isset($request->export_type)) {
            $rawQuery .= " LIMIT 50;";
        }

        $rawQueryFiltered = str_replace("WHERE AND", 'WHERE', $rawQuery);

        if (isset($request->export_type)) {
            GuestUserDataDownload::dispatch($rawQueryFiltered);
            return response('File is the generation in progress... Please refresh again after a few minutes.');
        }

        // Show Data
        $guestUserActivity = DB::select($rawQueryFiltered);
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
    }

    /**
     * @return BinaryFileResponse
     * File download
     */
    public function fileDownloadRequest()
    {
        $logUploadPath = env('GUEST_USER_LOG_FILE', "");
        $fileName = "guest_user.csv";
        $file = $logUploadPath . $fileName;
        $headers = array(
            'Content-Type: application/csv',
        );
        Redis::del("guest_user_file_generate_status");
        return Response::download($file, $fileName, $headers);
    }
}
