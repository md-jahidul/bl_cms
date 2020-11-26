<?php
namespace App\Repositories;

use App\Models\ProductDeepLink;


class ProductDeepLinkRepository extends BaseRepository
{
    public $modelName = ProductDeepLink::class;

    public function findOneProductLink($id)
    {
        return $this->model->where('product_code', $id)->first();
    }
}
