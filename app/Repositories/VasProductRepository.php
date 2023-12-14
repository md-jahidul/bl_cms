<?php
namespace App\Repositories;

use App\Models\VasProduct;

class VasProductRepository extends BaseRepository
{
    public $modelName = VasProduct::class;

    public function productSpecialType()
    {
        return $this->model::orderBy('display_order', 'desc')->first();
    }
}
