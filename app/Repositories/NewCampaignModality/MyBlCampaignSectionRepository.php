<?php

namespace App\Repositories\NewCampaignModality;

use App\Models\NewCampaignModality\MyBlCampaignSection;
use App\Repositories\BaseRepository;


class MyBlCampaignSectionRepository extends BaseRepository
{

    public $modelName = MyBlCampaignSection::class;

    public function destroy($id)
    {
        return MyBlCampaignSection::where('id',$id)->delete();
    }
}
