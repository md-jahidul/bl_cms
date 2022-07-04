<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\NewCampaignModality\MyBlCampaignWinner;

class CampaignNewModalityWinnerRepository extends BaseRepository
{
    public $modelName = MyBlCampaignWinner::class;

    public function setWinner($winnerData) 
    {
        $status = false;
        $winnerExists = $this->model
                             ->where('my_bl_campaign_id', $winnerData['my_bl_campaign_id'])
                             ->where('winning_slot_start', $winnerData['winning_slot_start'])
                             ->where('winning_slot_end', $winnerData['winning_slot_end'])
                             ->exists();

        if(!$winnerExists) {
            $result = $this->model->create($winnerData);
            $status = !is_null($result);
        }
        
        return $status;
    }
}
