<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\MyblCampaignProduct;
use App\Models\NewCampaignModality\MyBlCampaignDetail;

class CampaignNewModalityDetailRepository extends BaseRepository
{
    public $modelName = MyBlCampaignDetail::class;
}