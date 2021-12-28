<?php

namespace App\Services;

use App\Models\NonBlNumberRequestLog;
use Carbon\Carbon;

class NonBlNumberLogService
{
    public function getLogs($request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $builder = new NonBlNumberRequestLog();

        if (isset($request->search['value'])) {
            $keyWord = $request->search['value'];
            $builder = $builder->where('msisdn', 'LIKE', "%$keyWord%");
        }
        $all_items_count = $builder->count();
        $items = $builder->skip($start)->take($length)->get();

        $response = [
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count,
            'data' => []
        ];

        $items->each(function ($item) use (&$response) {
            $response['data'][] = [
                'msisdn' => $item->msisdn,
                'device_id' => $item->device_id,
                'failed_massage' => $item->failed_massage,
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('Y-m-d H:i:s'),
            ];
        });
        return $response;
    }
}
