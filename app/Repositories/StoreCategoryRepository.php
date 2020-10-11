<?php
namespace App\Repositories;

use App\Models\MyBlStoreCategory;

class StoreCategoryRepository extends BaseRepository
{
    public $modelName = MyBlStoreCategory::class;



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
