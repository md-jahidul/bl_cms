<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\HealthHubAnalyticDetails;
use App\Models\MyblHealthHub;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HealthHubRepository extends BaseRepository
{
    public $modelName = MyblHealthHub::class;

    public function itemTableSort($request)
    {
        $positions = $request->position;
        foreach ($positions as $position) {
            $menu_id = $position[0];
            $new_position = $position[1];
            $update_menu = $this->model->findOrFail($menu_id);
            $update_menu['display_order'] = $new_position;
            $update_menu->update();
        }
        return "success";
    }

    public function getAnalyticData($request)
    {
        $from = "";
        $to = "";
        if (isset($request->date_range)) {
            $date = explode(' - ', $request->date_range);
            $from = Carbon::createFromFormat('Y/m/d', $date[0])->toDateString();
            $to = Carbon::createFromFormat('Y/m/d', $date[1])->toDateString();
        }

        return $this->model
            ->with([
               'healthHubAnalytics' => function ($q) use ($from, $to) {
                   if (!empty($from)) {
                       $q->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59']);
                   }
               },
               'healthHubAnalyticsDetails' => function ($q) use ($from, $to) {
                   if (!empty($from)) {
                       $q->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59']);
                   }
               }
            ])->get();
    }

    public function getItemDetailsData($request, $itemId)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = new HealthHubAnalyticDetails();

        $builder = $builder->where('health_hub_id', $itemId);
        $builder = $builder->groupBy('msisdn');
        $builder = $builder->get();
        $from = "";
        $to = "";
//        $builder = $builder->with([
//           'healthHubAnalytics' => function ($q) use ($from, $to) {
//               if (!empty($from)) {
//                   $q->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59']);
//               }
//           },
//           'healthHubAnalyticsDetails' => function ($q) use ($from, $to) {
//               if (!empty($from)) {
//                   $q->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59']);
//               }
//           }
//       ]);

//        $all_items_count = $builder->count();
//        $data = $builder->skip($start)->take($length)->orderBy('created_at', 'DESC')->get();

/*        $data = $data->map(function ($item) {
//            dd($item->groupBy('msisdn'));
            return $item->groupBy('msisdn');
        });*/

        dd($data);

        return [
            'data' => $data,
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count
        ];


        $data = $analyticData->map(function ($item) {
            return [
                'icon' => $item->icon,
                'title_en' => $item->title_en,
                "total_hit_count" => $item->healthHubAnalytics->sum('hit_count'),
                "total_session_time" => $item->healthHubAnalytics->sum('total_session_time'),
                "total_unique_hit" => $item->healthHubAnalyticsDetails->groupBy('msisdn')->count(),
            ];
        });
    }
}
