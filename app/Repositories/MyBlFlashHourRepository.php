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

    public function msisdnInfo($request, $id)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = new FlashHourPurchaseMsisdnReport();

        $builder = $builder->where('purchase_report_id', $id);

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

        return [
            'data' => $data,
            'total_success' => 10,
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count
        ];
    }
}
