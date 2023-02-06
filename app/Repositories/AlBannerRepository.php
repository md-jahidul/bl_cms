<?php

namespace App\Repositories;

use App\Models\AlBanner;

class AlBannerRepository extends BaseRepository
{
    protected $modelName = AlBanner::class;


    public function findFirstBanner($param)
    {
        $banner = AlBanner::where('section_type', $param['section_type'])->where('section_id', $param['section_id'])->first();

        return $banner;
    }
}
