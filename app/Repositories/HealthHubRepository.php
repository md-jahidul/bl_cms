<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\MyblHealthHub;
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

    public function getAnalyticData()
    {
        return $this->model
            ->with([
               'healthHubAnalytics' => function ($q) {
//                $q->select('msisdn', DB::raw('count(msisdn) quantity'))->groupBy('msisdn');
//                $q->count(DB::raw('DISTINCT msisdn'));
//                   $q->select('msisdn', DB::raw('count(msisdn) unique_hits'))->groupBy('msisdn');
                   $q->select('msisdn');
                   $q->distinct();
                   $q->count();
               }
            ])
            ->get();
    }
}
