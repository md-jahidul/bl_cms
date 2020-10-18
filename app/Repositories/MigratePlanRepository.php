<?php

namespace App\Repositories;

use App\Models\MigratePlan;

/**
 * Class MigratePlanRepository
 * @package App\Repositories
 */
class MigratePlanRepository extends BaseRepository
{
    public $modelName = MigratePlan::class;


    /**
     * @return mixed
     */
    public function getMigratePlanListList()
    {
        return $this->model->orderBy('display_order', 'ASC')->get();
    }

    /**
     * @param $request
     * @return string
     */
    public function sortMyBlStoreList($request)
    {
        $positions = $request->position;

        return $this->sortData($positions);
    }
}
