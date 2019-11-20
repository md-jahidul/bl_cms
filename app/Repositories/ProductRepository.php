<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:07
 */

namespace App\Repositories;

use App\Models\Product;
use App\Models\SimCategory;

class ProductRepository extends BaseRepository
{
    public $modelName = Product::class;

    /**
     * @param $request
     */
    public function productOfferTableSort($request)
    {
        $positions = $request->position;
        foreach ($positions as $position) {
            $menu_id = $position[0];
            $new_position = $position[1];
            $update_menu = $this->model->findOrFail($menu_id);
            $update_menu['display_order'] = $new_position;
            $update_menu->update();
        }
    }

    public function relatedProducts($type, $id)
    {
        $products = $this->model::category($type)->where('id', '!=', $id)->get();
        return $products;
    }
}
