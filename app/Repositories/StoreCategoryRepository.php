<?php
namespace App\Repositories;

use App\Models\MyBlStoreCategory;

class StoreCategoryRepository extends BaseRepository
{
    public $modelName = MyBlStoreCategory::class;


    /**
     * @return mixed
     */
    public function getMyBlCategoryList()
    {
        return $this->model->orderBy('display_order', 'ASC')->get();
    }

    /**
     * @param $request
     * @return string
     */
    public function sortMyBlCategoryList($request)
    {
        $positions = $request->position;

        return $this->sortData($positions);
    }
}
