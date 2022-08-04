<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\NewCampaignModality\MyBlCampaignUser;

class CampaignNewModalityUserRepository extends BaseRepository
{
    public $modelName = MyBlCampaignUser::class;

    public function getCampaignFirstTypeUser($product, $slotStarts, $slotEnds) {
        return $this->model->where(function($q) use ($product, $slotStarts, $slotEnds){
            // $q->where('my_bl_campaign_detail_id', $product->id);
            $q->where('my_bl_campaign_id', $product->my_bl_campaign_id);
            $q->where('created_at', '>=', $slotStarts);
            $q->where('created_at', '<=', $slotEnds);
        })
        ->selectRaw('msisdn')
        ->orderBy('created_at', 'asc')
        ->first();
    }

    public function getCampaignHighestTypeUser($product, $slotStarts, $slotEnds) {
        return $this->model->where(function($q) use ($product, $slotStarts, $slotEnds){
            // $q->where('my_bl_campaign_detail_id', $product->id);
            $q->where('my_bl_campaign_id', $product->my_bl_campaign_id);
            $q->where('created_at', '>=', $slotStarts);
            $q->where('created_at', '<=', $slotEnds);
        })
        ->groupBy('msisdn')
        ->selectRaw('msisdn, sum(amount) as amount_sum')
        ->orderBy('amount_sum', 'DESC')
        ->first();
    }
}
