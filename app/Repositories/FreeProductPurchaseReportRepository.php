<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\AboutPage;
use App\Models\FreeProductPurchaseMsisdn;
use App\Models\FreeProductPurchaseReport;
use App\Models\Prize;

class FreeProductPurchaseReportRepository extends BaseRepository
{
    public $modelName = FreeProductPurchaseReport::class;

    public function purchaseCodeWithMsisdn($date)
    {
        return $this->model
            ->with([
               'purchaseMsisdns' => function ($q) use ($date) {
                   if (isset($date['date_range'])) {
                       $date = explode('-', str_replace(' ', '', $date['date_range']));
                       $startDate = str_replace('/', '-', $date[0]) . " 00.00.01";
                       $endDate = str_replace('/', '-', $date[1]) . " 23:59:59";
                       $q->whereBetween('created_at', [$startDate, $endDate]);
                   }
               }
            ])
            ->get();
    }

    public function msisdnInfo($request, $id)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = new FreeProductPurchaseMsisdn();

        $builder = $builder->where('purchase_report_id', $id);

        if (isset($request->msisdn)) {
            $builder = $builder->where('msisdn', 'like', '%' . $request->msisdn . '%');
        }

        if (isset($request->date_range)) {
            $dateRange = explode('-', str_replace(' ', '', $request->date_range));
            $startDate = str_replace('/', '-', $dateRange[0]) . " 00.00.00";
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
