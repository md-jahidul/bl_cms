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
use App\Models\Referrer;

class MyBlReferAndEarnRepository extends BaseRepository
{
    public $modelName = ReferAndEarn::class;

    public function referAndEarnData($campaignId = null)
    {
        $data = $this->model
            ->select('id', 'campaign_title')
            ->withCount('referrers')
            ->with(['referrers' => function ($q) {
                $q->select('id', 'refer_and_earn_id', 'msisdn', 'referral_code', 'created_at');
                $q->withCount('referees');
                $q->with(['referees' => function ($referees) {
                    $referees->select('id', 'referrer_id', 'status');
                }]);
            }]);

        if (isset($campaignId)) {
            $data = $data->where('id', $campaignId);
            $data = $data->first();
        } else {
            $data = $data->get();
        }
        return $data;
    }

    public function refereeInfo($request, $id)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = new Referee();

        $builder = $builder->where('referrer_id', $id);

//        if ($request->title) {
//            $builder = $builder->where('title', $request->title);
//        }
//
//        if ($request->type) {
//            $builder = $builder->where('type', $request->type);
//        }

        $all_items_count = $builder->count();
        $data = $builder->skip($start)->take($length)->orderBy('created_at', 'DESC')->get();
        return [
            'data' => $data,
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count
        ];

//        return Referrer::where('id', $id)
//            ->with(['referees' => function ($q) {
////                $q->select('id', 'refer_and_earn_id', 'status');
////                $q->with(['referees' => function ($referees) {
////                    $referees->select('id', 'referrer_id', 'status');
////                }]);
//            }])->first();
    }
}
