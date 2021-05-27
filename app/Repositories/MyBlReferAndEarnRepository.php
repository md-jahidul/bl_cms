<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\ReferAndEarn;
use App\Models\Referee;
use Carbon\Carbon;

class MyBlReferAndEarnRepository extends BaseRepository
{
    public $modelName = ReferAndEarn::class;

    public function referAndEarnData($request = null, $campaignId = null)
    {
        $data = $this->model
            ->select('id', 'campaign_title')
            ->with(['referrers' => function ($q) use ($request) {
                if (isset($request->date_range)) {
                    $date = explode(' - ', $request->date_range);
                    $from = Carbon::createFromFormat('Y/m/d', $date[0])->toDateString();
                    $to = Carbon::createFromFormat('Y/m/d', $date[1])->toDateString();
                    $q->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59']);
                }
                if (isset($request->msisdn)) {
                    $q->where('msisdn', $request->msisdn);
                }

                $q->select('id', 'refer_and_earn_id', 'msisdn', 'referral_code', 'created_at');
                $q->withCount('referees');
                $q->with(['referees' => function ($referees) {
                    $referees->select('id', 'referrer_id', 'status');
                }]);
            }]);
//            ->withCount('referrers');


        if (isset($campaignId)) {
            $data = $data->where('id', $campaignId);
            $data = $data->first();
        } else {
            $data = $data->get();
        }

//        dd($data);

//        dd($request->all());

        return $data;
    }

    public function refereeInfo($request, $id)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = new Referee();

        $builder = $builder->where('referrer_id', $id);

        $all_items_count = $builder->count();
        $data = $builder->skip($start)->take($length)->orderBy('created_at', 'DESC')->get();
        return [
            'data' => $data,
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count
        ];
    }
}
