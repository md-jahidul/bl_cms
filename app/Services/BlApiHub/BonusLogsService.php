<?php

namespace App\Services\BlApiHub;

use App\Models\AuditLog;
use App\Models\SignInBonusLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class AuditLogsService
 * @package App\Services\BlApiHub
 */
class BonusLogsService
{
    public function getLogs(Request $request, $number)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $date = $request->date ? $request->date : Carbon::now()->toDateString();

        $builder = SignInBonusLog::where('msisdn', substr($number, 1));

        $builder = $builder->where('date', $date);
        $all_items_count = $builder->count();


        $items = $builder->orderBy('date', 'desc')->skip($start)->take($length)->get();

        $response = [
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count,
            'data' => []
        ];

        $items->each(function ($item) use (&$response) {
            $response['data'][] = [
                'date'              => $item->date,
                'bonus_type'        => $item->bonus_type,
                'status'            => $item->status
            ];
        });

        return $response;
    }
}
