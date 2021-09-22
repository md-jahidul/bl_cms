<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\AboutPage;
use App\Models\MyblCashBack;
use App\Models\Prize;

class MyblCashBackRepository extends BaseRepository
{
    public $modelName = MyblCashBack::class;

    public function inactiveOldCampaign()
    {
        $campaigns = $this->model->all();
        foreach ($campaigns as $campaign) {
            $campaign->update(['status' => 0]);
        }
    }
}
