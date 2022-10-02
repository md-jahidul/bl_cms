<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\NewCampaignModality\MyBlCampaignDetail;
use Carbon\Carbon;

class CampaignNewModalityDetailRepository extends BaseRepository
{
    public $modelName = MyBlCampaignDetail::class;

    public function getRunningCampaignProducts ($winningType = null)
    {
        $winningType = $winningType === 'MAX' ? 'highest_recharge' : null;
        $winningType = $winningType === 'FIRST' ? 'first_recharge' : null;

        $withArr = [
            'campaign' => function ($q) {
                $q->select([
                    'id',
                    'status',
                    'first_sign_up_user',
                    'recurring_type',
                    'name',
                    'start_date',
                    'end_date',
                    'winning_type',
                    'winning_interval',
                    'winning_interval_unit',
                    'winning_massage_en',
                    'bonus_product_code',
                    'winning_title'
               ]);
            }
        ];

        return $this->model
            ->with($withArr)
            ->get()
            // ->where('status', 1)
            // ->where('campaign.status', 1)
            ->where('campaign.start_date', '<=', Carbon::now()->toDateTimeString())
            ->where('end_date', '>=', Carbon::now()->addHour(-1)->toDateTimeString())
            ->where('campaign.end_date', '>=', Carbon::now()->addHour(-1)->toDateTimeString());
            // ->groupBy('campaign.winning_type');
    }
}
