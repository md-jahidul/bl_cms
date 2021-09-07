<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\FlashHourPurchaseMsisdnReport;
use App\Models\FlashHourPurchaseReport;
use App\Models\MyblFlashHour;
use App\Models\Referee;
use Carbon\Carbon;

class MyBlFlashHourRepository extends BaseRepository
{
    public $modelName = MyblFlashHour::class;

    public function inactiveOldCampaign()
    {
        $campaigns = $this->model->all();
        foreach ($campaigns as $campaign) {
            $campaign->update(['status' => 0]);
        }
    }

//    public function referAndEarnData($request = null, $campaignId = null)
//    {
//        $data = $this->model
//            ->select('id', 'campaign_title', 'referrer_product_code', 'referee_product_code')
//            ->with(['referrers' => function ($q) use ($request) {
//                if (isset($request->date_range)) {
//                    $date = explode(' - ', $request->date_range);
//                    $from = Carbon::createFromFormat('Y/m/d', $date[0])->toDateString();
//                    $to = Carbon::createFromFormat('Y/m/d', $date[1])->toDateString();
//                    $q->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59']);
//                }
//                if (isset($request->msisdn)) {
//                    $q->where('msisdn', $request->msisdn);
//                }
//                $q->select('id', 'refer_and_earn_id', 'msisdn', 'referral_code', 'created_at');
//                $q->withCount('referees');
//                $q->with(['referees' => function ($referees) {
//                    $referees->select('id', 'referrer_id', 'status', 'is_invited');
//                }]);
//            }]);
//
//        if (isset($campaignId)) {
//            $data = $data->where('id', $campaignId);
//            $data = $data->first();
//        } else {
//            $data = $data->get();
//        }
//
//        return $data;
//    }

    public function msisdnInfo($request, $id)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = new FlashHourPurchaseMsisdnReport();

        $builder = $builder->where('purchase_report_id', $id);
//        $builder = $builder->with('purchaseMsisdns');

        if (isset($request->msisdn)) {
            $builder = $builder->where('msisdn', 'like', '%' . $request->msisdn . '%');
        }

        if (isset($request->date_range)) {
            $dateRange = explode('-', str_replace(' ', '', $request->date_range));
            $startDate = str_replace('/', '-', $dateRange[0]) . " 00.00.01";
            $endDate = str_replace('/', '-', $dateRange[1]) . " 23:59:59";
            $builder = $builder->whereBetween('created_at', [$startDate, $endDate]);
        }

        $all_items_count = $builder->count();
        $data = $builder->skip($start)->take($length)->get();

//        $data['purchase_msisdn'] = $data;

//        dd($data);

        return [
            'data' => $data,
//            'total_success' => 10,
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count
        ];
    }
}
