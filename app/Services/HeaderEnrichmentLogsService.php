<?php

namespace App\Services;

use App\Models\AuditLog;
use App\Models\HeaderEnrichmentLog;
use App\Models\SignInBonusLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class AuditLogsService
 * @package App\Services\BlApiHub
 */
class HeaderEnrichmentLogsService
{
    public function getLogs($request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $builder = new HeaderEnrichmentLog();
//        $builder = $builder->where('group_id', $id);

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
                'response_status' => $item->response_status,
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('Y-m-d H:i:s'),
            ];
        });
        return $response;
    }
}
