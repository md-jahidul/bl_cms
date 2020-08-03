<?php

namespace App\Services\BlApiHub;

use App\Models\BlOtpLoginLogs;
use App\Models\BlOtpVerifyLog;
use App\Models\AuditLog;
use Carbon\Carbon;
use Illuminate\Http\Request;


/**
 * Class OtpRequestLogsService
 * @package App\Services\BlApiHub
 */
class OtpRequestLogsService
{

    /**
     * @param Request $request
     * @param $number
     * @return array
     */
    public function getLogs(Request $request, $number)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $date = $request->date ? $request->date : Carbon::now()->toDateString();

        $builder = BlOtpVerifyLog::where('msisdn', $number);


        $builder = $builder->where('date', $date);


        $all_items_count = $builder->count();


        $items = $builder->orderBy('created_at', 'desc')->skip($start)->take($length)->get();

        $response = [
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count,
            'data' => []
        ];

        $items->each(
            function ($item) use (&$response) {
                $response['data'][] = [
                    'date' => Carbon::parse($item->created_at)->toDateTimeString(),
                    'msisdn' => $item->msisdn,
                    'otp' => $item->otp,
                    'source' => $item->source,
                    'version' => $item->version,
                    'status' => $item->status
                ];
            }
        );

        return $response;
    }


    /**
     * @param Request $request
     * @param $number
     * @return array
     */
    public function getOtpLoginLogs(Request $request, $number)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $date = $request->date ? $request->date : Carbon::now()->toDateString();

        $builder = BlOtpLoginLogs::where('msisdn', $number);


        $builder = $builder->where('created_at', $date);


        $all_items_count = $builder->count();


        $items = $builder->orderBy('created_at', 'desc')->skip($start)->take($length)->get();

        $response = [
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count,
            'data' => []
        ];

        $items->each(
            function ($item) use (&$response) {
                $response['data'][] = [
                    'date' => Carbon::parse($item->created_at)->toDateTimeString(),
                    'msisdn' => $item->msisdn,
                    'message' => $item->message,
                    'response' => $item->data,
                    'status' => $item->status
                ];
            }
        );

        return $response;
    }
}
