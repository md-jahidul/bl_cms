<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\NewCampaignModality\CampaignPurchaseReport;


class CampaignPurchaseReportRepository extends BaseRepository
{
    public $modelName = CampaignPurchaseReport::class;

    public function purchaseCodeWithMsisdn($date, $campaignId)
    {
        return $this->model
            ->where('campaign_id', $campaignId)
            ->where('campaign_id', $campaignId)
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

    public function deleteAllPurchaseReport($campaignId)
    {
//        dd($campaignId);
        return $this->model->whereIn('mybl_flash_hours_id', [$campaignId])->delete();
    }
}
