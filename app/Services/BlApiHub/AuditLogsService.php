<?php

namespace App\Services\BlApiHub;

use App\Models\AuditLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class AuditLogsService
 * @package App\Services\BlApiHub
 */
class AuditLogsService
{
    public function getLogs(Request $request, $number)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $date = $request->date ? $request->date : Carbon::now()->toDateString();

        $builder = AuditLog::where('msisdn', '88' . $number);

        $builder = $builder->whereBetween('created_at', [$date . '  00:00:00', $date . '  23:59:59']);
        $all_items_count = $builder->count();


        $items = $builder->orderBy('created_at', 'desc')->skip($start)->take($length)->get();

        $response = [
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count,
            'data' => []
        ];

        $items->each(function ($item) use (&$response) {
            $response['data'][] = [
                'browse_date'       => Carbon::parse($item->created_at)->toDateTimeString(),
                'source'            => $item->source,
                'browse_url'        => $item->browse_url,
                'request_data'      => $item->request_data
            ];
        });

        return $response;
    }
}
