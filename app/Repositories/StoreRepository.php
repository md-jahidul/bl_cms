<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\MyBlStore;

/**
 * Class StoreRepository
 * @package App\Repositories
 */
class StoreRepository extends BaseRepository
{
    public $modelName = MyBlStore::class;


    /**
     * @return mixed
     */
    public function getMyBlStoreList()
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
