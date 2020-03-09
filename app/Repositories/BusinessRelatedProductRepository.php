<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 01/03/2020
 */

namespace App\Repositories;

use App\Models\BusinessRelatedProducts;

class BusinessRelatedProductRepository extends BaseRepository {

    public $modelName = BusinessRelatedProducts::class;

    public function assignRelatedProduct($parentId, $parentType, $products) {

        //delete old priducts
        $this->model->where(array('product_type' => $parentType, 'parent_id' => $parentId))->delete();

        if (!empty($products)) {
            $data = [];
            foreach ($products as $pId => $v) {
                $data[] = array(
                    'product_id' => $pId,
                    'product_type' => $parentType,
                    'parent_id' => $parentId
                );
            }
            if (!empty($data)) {
                $this->model->insert($data);
            }
        }
        return true;
    }

    public function getRelatedProductList($parentId, $productType) {
        $data = $this->model->where(array(
                    'product_type' => $productType,
                    'parent_id' => $parentId
                ))->get();

        $related = [];
        foreach ($data as $p) {
            $related[] = $p->product_id;
        }
        return $related;
    }

}
