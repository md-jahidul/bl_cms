<?php

namespace App\Repositories;

use App\Models\AboutUsBanglalink;
use App\Models\AboutUsEcareerItem;

class AboutUsEcareerItemRepository extends BaseRepository
{
    public $modelName = AboutUsEcareerItem::class;


    /**
     * @param $request
     * @return string
     */
    public function sortAboutUsCareerItems($request)
    {
        $positions = $request->position;

        return $this->sortData($positions);
    }
}
