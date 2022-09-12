<?php

namespace App\Repositories\NewCampaignModality;

use App\Models\NewCampaignModality\CampaignPurchaseReport;

use App\Repositories\BaseRepository;


class CampaignPurchaseReportRepository extends BaseRepository
{

    public $modelName = CampaignPurchaseReport::class;

    public function purchaseCodeWithMsisdn($date, $campaignId)
    {
        return $this->model
            ->where('campaign_id', $campaignId)
            ->where('campaign_type', 'new-campaign-modality')
            ->with([
                'msisdnReports' => function ($q) use ($date) {
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

//    public function deleteAllPurchaseReport($campaignId)
//    {
//        return $this->model->whereIn('mybl_flash_hours_id', [$campaignId])->delete();
//    }
}
