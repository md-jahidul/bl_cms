<?php

namespace App\Repositories;

use App\Models\MyblAdTech;

class MyblAdTechRepository extends BaseRepository
{
    public $modelName = MyblAdTech::class;

    public function updateOrderingPosition($request)
    {
        $positions = $request->position;
        $this->sortData($positions);
    }
    public function allInactive() {
        $this->model::where('status', 1)->update(['status' => 0]);
    }
}
