<?php

namespace App\Repositories;

use App\Models\MyBlProduct;

class MyBlProductRepository extends BaseRepository
{
    public $modelName = MyBlProduct::class;

    public function updateDataById($id, $data)
    {
        return $this->model::where('id', $id)->update($data);
    }
}
