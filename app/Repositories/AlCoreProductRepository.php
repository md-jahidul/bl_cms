<?php
namespace App\Repositories;

use App\Models\Product;
use App\Models\SimCategory;
use App\Models\AlCoreProduct;


class AlCoreProductRepository extends BaseRepository
{
    public $modelName = AlCoreProduct::class;

    /**
     * @param $id
     * @return mixed
     */
    public function findWithProduct($id)
    {
        return $this->model->where('product_code', $id)->with(['product', 'offer_category' => function ($query) {
            $query->select('id', 'name_en');
        }])->first();
    }

    public function findOneProductCore($id)
    {
        return $this->model->where('product_code', $id)->first();
    }
}
