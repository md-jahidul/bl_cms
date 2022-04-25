<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\MyblDeeplinkMsisdnCount;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DeeplinkMsisdnHitCountRepository extends BaseRepository
{
    public $modelName = MyblDeeplinkMsisdnCount::class;

    public function deeplinkAnalyticMsisdnCount($request, $dynamicDeepLinkId)
    {

        $builder = new MyblDeeplinkMsisdnCount();
        $builder = $builder->where('dynamic_deeplink_id', $dynamicDeepLinkId);

        if (isset($request->date_range)) {
            $date = explode(' - ', $request->date_range);
            $from = Carbon::createFromFormat('Y/m/d', $date[0])->toDateString();
            $to = Carbon::createFromFormat('Y/m/d', $date[1])->toDateString();
            $builder = $builder->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59']);
        }

        $data = $builder
            ->select(DB::raw('msisdn, count(*) as hit_count'))
            ->groupBy('msisdn')
            ->orderBy('hit_count', "DESC")
            ->get();

        if (isset($request->excel_export)) {
            return $data;
        }

        $all_items_count = $data->count();
        $start = $request->get('start');
        $length = $request->get('length');
        $data = collect($data)->slice($start, $length);

        $draw = $request->get('draw');

        return [
            'data' => array_values($data->toArray()),
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count
        ];
    }
}
