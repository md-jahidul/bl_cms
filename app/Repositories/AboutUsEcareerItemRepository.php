<?php

namespace App\Repositories;

use App\Models\AboutUsBanglalink;
use App\Models\AboutUsEcareerItem;

/**
 * Class AboutUsEcareerItemRepository
 * @package App\Repositories
 */
class AboutUsEcareerItemRepository extends BaseRepository
{
    public $modelName = AboutUsEcareerItem::class;

    /**
     * @return mixed
     */
    public function getAboutUsCareerItems($id)
    {
        return $this->model->where('about_us_ecareers_id', $id)->orderBy('display_order', 'ASC')->get();
    }


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
