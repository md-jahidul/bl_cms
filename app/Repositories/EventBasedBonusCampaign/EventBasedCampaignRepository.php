<?php

namespace App\Repositories\EventBasedBonusCampaign;

use App\Models\EventBasedBonusCampaign\EventBasedCampaign;
use App\Repositories\BaseRepository;

class EventBasedCampaignRepository extends BaseRepository
{
    protected $modelName = EventBasedCampaign::class;
}
