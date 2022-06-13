<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services\NewCampaignModality;

use App\Repositories\NewCampaignModality\MyBlCampaignSectionRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class MyBlCampaignSectionService
{
    use CrudTrait;
    private $myblCampaignSectionRepository;

    public function __construct(MyBlCampaignSectionRepository $myblCampaignSectionRepository)
    {
        $this->myblCampaignSectionRepository = $myblCampaignSectionRepository;
    }

    public function findAll()
    {
        return $this->myblCampaignSectionRepository->findAll();
    }
}
