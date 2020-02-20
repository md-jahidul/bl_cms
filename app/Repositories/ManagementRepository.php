<?php

namespace App\Repositories;

use App\Models\AboutUsManagement;

class ManagementRepository extends BaseRepository
{
    public $modelName = AboutUsManagement::class;

    /**
     * @return mixed
     */
    public function getManagementInfo()
    {
        return $this->model->orderBy('display_order', 'ASC')->get();
    }

    /**
     * @param $request
     * @return string
     */
    public function sortManangementInfo($request)
    {
        $positions = $request->position;

        return $this->sortData($positions);
    }
}
