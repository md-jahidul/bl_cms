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
           ])->orderBy('display_order', 'ASC')->get();
}

    public function getItemDetailsData($request, $itemId)
    {
        $builder = new HealthHubAnalyticDetails();
        $builder = $builder->where('health_hub_id', $itemId);

        if (isset($request->date_range)) {
            $date = explode(' - ', $request->date_range);
            $from = Carbon::createFromFormat('Y/m/d', $date[0])->toDateString();
            $to = Carbon::createFromFormat('Y/m/d', $date[1])->toDateString();
            $builder = $builder->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59']);
        }

        if (isset($request->excel_export)) {
            $data = $builder->get();
        } else {
            $data = $builder->orderBy('created_at', 'DESC')->get();
        }

        $data = $data->groupBy('msisdn')->map(function ($builder) {
            return $builder->count();
        });

        if (!isset($request->excel_export)) {
            $all_items_count = $data->count();
            $start = $request->get('start');
            $length = $request->get('length');
            $data = collect($data)->slice($start, $length);
        }


        $msisdn = [];
        foreach ($data as $key => $uniqueMsisdn) {
            $msisdn[] = [
                'msisdn' => $key,
                'hit_count' => $uniqueMsisdn
            ];
        }

        $msisdn = collect($msisdn)->sortBy('hit_count', null, true);

        if (isset($request->excel_export)) {
            return $msisdn;
        }

        $draw = $request->get('draw');

        return [
            'data' => array_values($msisdn->toArray()),
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count
        ];
    }
}
