<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\AboutPage;
use App\Models\Prize;
use App\Models\ProductDetailsSection;

class ProductDetailsSectionRepository extends BaseRepository
{
    public $modelName = ProductDetailsSection::class;

    public function productDetailsSection($productId)
    {
        return $this->model->where('product_id', $productId)
            ->orderBy('display_order', 'ASC')
            ->get();
    }

    public function sectionTableSort($request)
    {
        $positions = $request->position;
        foreach ($positions as $position) {
            $menu_id = $position[0];
            $new_position = $position[1];
            $update_menu = $this->model->findOrFail($menu_id);
            $update_menu['display_order'] = $new_position;
            $update_menu->update();
        }
        return "success";
    }
}
