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
        return $this->model->get();
    }
}
