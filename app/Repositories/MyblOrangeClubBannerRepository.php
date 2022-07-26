<?php

namespace App\Repositories;


use App\Models\MyblOrangeClubBanner;

class MyblOrangeClubBannerRepository extends BaseRepository
{

    public $modelName = MyblOrangeClubBanner::class;

    public function updateOrderingPosition($request)
    {
        $positions = $request->position;
        $this->sortData($positions);

    }
}
