<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 20/03/2020
 */

namespace App\Repositories;

use App\Models\RoamingOfferCategory;
use App\Models\RoamingOtherOffer;
use App\Models\RoamingOtherOfferComponents;

class RoamingOfferRepository extends BaseRepository {

    public $modelName = RoamingOtherOffer::class;

    public function getCategoryList() {
        $categories = RoamingOfferCategory::orderBy('sort')->get();
        return $categories;
    }

    public function getCategory($catId) {
        $categoriy = RoamingOfferCategory::findOrFail($catId);
        return $categoriy;
    }

    public function updateCategory($request) {
        try {

            if ($request->cat_id != "") {
                $category = RoamingOfferCategory::findOrFail($request->cat_id);
            } else {
                $category = new RoamingOfferCategory();
            }

            $category->name_en = $request->name_en;
            $category->name_bn = $request->name_bn;
            $category->status = $request->status;
            $category->save();

            $response = [
                'success' => 1,
            ];
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'errors' => $e->getMessage()
            ];
        }
        return $response;
    }

    public function changeCategorySorting($request) {
        try {

            $positions = $request->position;
            foreach ($positions as $position) {
                $categoryId = $position[0];
                $new_position = $position[1];
                $update = RoamingOfferCategory::findOrFail($categoryId);
                $update['sort'] = $new_position;
                $update->update();
            }

            $response = [
                'success' => 1,
                'message' => 'Success',
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    public function getOffers() {
        $response = $this->model->select('roaming_other_offer.*', 'c.name_en as category_name')
                        ->leftJoin('roaming_other_offer_category as c', 'c.id', '=', 'roaming_other_offer.category_id')
                        ->orderBy('roaming_other_offer.id', 'desc')->get();
        return $response;
    }

    public function getOfferById($offerId) {
        $response = $this->model->findOrFail($offerId);
        return $response;
    }

    public function saveOffer($webPath, $mobilePath, $request) {
        try {

            if ($request->offer_id == "") {
                $offer = $this->model;
            } else {
                $offer = $this->model->findOrFail($request->offer_id);
            }

            $offer->category_id = $request->category_id;
            $offer->name_en = $request->name_en;
            $offer->name_bn = $request->name_bn;
            $offer->card_text_en = $request->card_text_en;
            $offer->card_text_bn = $request->card_text_bn;
            $offer->short_text_en = $request->short_text_en;
            $offer->short_text_bn = $request->short_text_bn;
            $offer->details_en = $request->details_en;
            $offer->details_bn = $request->details_bn;
            $offer->banner_name = $request->banner_name;
            $offer->banner_web = $webPath;
            $offer->banner_mobile = $mobilePath;
            $offer->alt_text = $request->alt_text;
            $offer->url_slug = $request->url_slug;
            $offer->page_header = $request->html_header;
            $offer->schema_markup = $request->schema_markup;
            $offer->status = $request->status;
            $offer->save();

            $response = [
                'success' => 1,
            ];
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'errors' => $e->getMessage()
            ];
        }
        return $response;
    }

    public function deleteOffer($offerId) {
        try {
            $this->model->findORFail($offerId)->delete();
            $response = [
                'success' => 1,
            ];
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'errors' => $e->getMessage()
            ];
        }
        return $response;
    }
    
     public function getOfferComponents($offerId) {
        $response = RoamingOtherOfferComponents::where('parent_id', $offerId)->get();
        return $response;
    }

}
