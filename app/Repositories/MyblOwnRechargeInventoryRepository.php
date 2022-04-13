<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\AboutPage;
use App\Models\MyBlOwnRechargeInvertory;
use App\Models\Prize;

class MyblOwnRechargeInventoryRepository extends BaseRepository
{
    public $modelName = MyBlOwnRechargeInvertory::class;

    public function inactiveOldCampaign()
    {
        $campaigns = $this->model->all();
        foreach ($campaigns as $campaign) {
            $campaign->update(['status' => 0]);
        }
    }
}
