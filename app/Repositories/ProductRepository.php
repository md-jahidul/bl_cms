<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:07
 */

namespace App\Repositories;

use App\Enums\OfferType;
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
        return $this->model::category($type)
            ->where('status', 1)
            ->whereIn('offer_category_id', [OfferType::INTERNET, OfferType::VOICE, OfferType::BUNDLES])
            ->productCore()
            ->select('id', 'product_code', 'name_en', 'name_bn', 'special_product', 'purchase_option')
            ->get();
    }

    public function findByCode($type, $id)
    {
        return $this->model->category($type)
            ->where('product_code', $id)
            ->with('product_core')
            ->first();
    }

    public function countBondhoSimOffer()
    {
        return $this->model->where('offer_info->other_offer_type_id', OfferType::BONDHO_SIM_OFFER)
            ->get();
    }

    public function getProductsForSearch($type)
    {
        $products = $this->model->select('id', 'name_en')->orderBy('name_en')->where('status', 1);

        if ($type == 'prepaid-internet') {
            $products->where(array('sim_category_id' => 1, 'offer_category_id' => 1));
        }
        if ($type == 'prepaid-voice') {
            $products->where(array('sim_category_id' => 1, 'offer_category_id' => 2));
        }
        if ($type == 'prepaid-bundle') {
            $products->where(array('sim_category_id' => 1, 'offer_category_id' => 3));
        }
        if ($type == 'postpaid-internet') {
            $products->where(array('sim_category_id' => 2, 'offer_category_id' => 1));
        }

        $data = $products->where('name_en', '!=', "")->get();

        return $data;
    }

    public function getOfferCatWise($offerCatId, $type, $productId = null)
    {
        $data = $this->model->where('offer_category_id', $offerCatId)
            ->select('id', 'name_en as name')
            ->category($type);
        if ($productId) {
            $data->where('id', $productId);
            return $data->first();
        }
        return $data->get();
    }
}
