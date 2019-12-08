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
use Illuminate\Support\Facades\DB;

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

    public function productDetails($id)
    {
        return $this->model->where('product_code', $id)->with('other_related_product', "related_product", 'product_details')->first();
    }

    /**
     * @param $type
     * @param $id
     * @return mixed
     */
    public function relatedProducts($type, $id)
    {

//        dd($type);
        $products = $this->model::category($type)->where('id', '!=', $id)->get();
//        $products = $this->model::where('id', '!=', $id)->get();

//        $products = DB::table('products')
//            ->where('id', '!=', $id)
//            ->join('product_cores as pc', 'products.product_code', '=', 'pc.product_code')
//            ->join('offer_categories as oc', 'pc.product_type_id', '=', 'oc.id') // you may add more joins
//            ->select('products.*', 'pc.*', 'oc.name_en as offer_type', 'oc.alias as offer_type_alias')
////            ->orderBy('po.display_order')
//            ->get();


        return $products;
    }

    public function findByCode($type, $id)
    {
        return $this->model->category($type)->where('product_code', $id)->with('product_core')->first();
    }

}
