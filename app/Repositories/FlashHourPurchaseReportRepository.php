<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\AboutPage;
use App\Models\FlashHourPurchaseReport;
use App\Models\Prize;

class FlashHourPurchaseReportRepository extends BaseRepository
{
    public $modelName = FlashHourPurchaseReport::class;

    public function purchaseCodeWithMsisdn($date, $campaignId)
    {
        return $this->model
            ->where('mybl_flash_hours_id', $campaignId)
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
}
