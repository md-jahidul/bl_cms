<?php

namespace App\Repositories;

use App\Models\MyBlContactRestoreLog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ContactRestoreLogRepository extends BaseRepository
{
    /**
     * @var MyBlContactRestoreLog
     */
    protected $model;

    /**
     * ContactRestoreLogRepository constructor.
     * @param MyBlContactRestoreLog $contactRestoreLog
     */
    public function __construct(MyBlContactRestoreLog $contactRestoreLog)
    {
        $this->model = $contactRestoreLog;
    }

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

        $query = MyBlContactRestoreLog::where('mobile_number', $number);

        if ($request->date) {
            $date = explode('--', $request->date);
            $from = Carbon::createFromFormat('Y/m/d', $date[0])->toDateString();
            $to = Carbon::createFromFormat('Y/m/d', $date[1])->toDateString();
            $query->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59']);
        }

        $all_items_count = $query->count();
        $items = $query->orderBy('created_at', 'desc')->skip($start)->take($length)->get();

        $response = [
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count,
            'data' => []
        ];

        $items->each(function ($item) use (&$response) {
            $response['data'][] = [
                'contact_backup_id' => $item->contact_backup_id,
                'message' => $item->message,
                'date_time' => $item->date_time,
                'platform' => $item->platform,
                'device_os' => $item->device_os,
                'device_model' => $item->device_model,
                'mobile_number' => $item->mobile_number,
                'total_number_to_be_restore' => $item->total_number_to_be_restore,
                'total_restore' => $item->total_restore,
            ];
        });

        return $response;
    }
}
