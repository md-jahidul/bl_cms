<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 20/03/2020
 */

namespace App\Repositories;

use App\Models\RoamingOfferCategory;
use App\Models\RoamingOtherOffer;
use App\Models\RoamingOtherOfferComponents;
use Illuminate\Support\Facades\Auth;

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

    public function saveOffer($webPath, $mobilePath, $cardImagePath, $request) {
        try {
            if ($request->offer_id == "") {
                $offer = $this->model;
                $offer->created_by = Auth::id();
            } else {
                $offer = $this->model->findOrFail($request->offer_id);
                $offer->updated_by = Auth::id();
            }

            $offer->category_id = $request->category_id;
            $offer->name_en = $request->name_en;
            $offer->name_bn = $request->name_bn;
            $offer->card_text_en = $request->card_text_en;
            $offer->card_text_bn = $request->card_text_bn;
            $offer->card_image = $cardImagePath;
            $offer->short_text_en = $request->short_text_en;
            $offer->short_text_bn = $request->short_text_bn;
            $offer->banner_name = $request->banner_name;
            $offer->banner_web = $webPath;
            $offer->banner_mobile = $mobilePath;
            $offer->banner_title_en = $request->banner_title_en;
            $offer->banner_title_bn = $request->banner_title_bn;
            $offer->banner_desc_en = $request->banner_desc_en;
            $offer->banner_desc_bn = $request->banner_desc_bn;
            $offer->alt_text = $request->alt_text;
            $offer->url_slug = $request->url_slug;
            $offer->url_slug_bn = $request->url_slug_bn;
            $offer->page_header = $request->html_header;
            $offer->page_header_bn = $request->page_header_bn;
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
            RoamingOtherOfferComponents::where('parent_id', $offerId)->delete();
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
        $response = RoamingOtherOfferComponents::where('parent_id', $offerId)->orderBy('position')->get();
        return $response;
    }

    public function saveComponents($request) {
        try {


            //delete all previous components
            RoamingOtherOfferComponents::where(array('parent_id' => $request->parent_id))->delete();

            $insert = [];

            $count = 0;
            foreach ($request->component_position as $k => $val) {
                $insert[$count]['parent_id'] = $request->parent_id;

                if (isset($request->head_en[$k])) {

                     $tableArrayEn = array(
                        'head_en' => $request->head_en[$k],
                        'rows_en' => $request->col_en[$k]
                    );
                    $tableJsonEn = json_encode($tableArrayEn);

                     $tableArrayBn = array(
                        'head_bn' => $request->head_bn[$k],
                        'rows_bn' => $request->col_bn[$k]
                    );
                    $tableJsonBn = json_encode($tableArrayBn);

                    $insert[$count]['body_text_en'] = $tableJsonEn;
                    $insert[$count]['body_text_bn'] = $tableJsonBn;

                    $insert[$count]['position'] = $k;
                    $insert[$count]['component_type'] = 'table';
                }

                if (isset($request->headline_en[$k])) {

                    $textArrayEn = array(
                        'headline_en' => $request->headline_en[$k],
                        'text_en' => $request->textarea_en[$k]
                    );
                    $textJsonEn = json_encode($textArrayEn);

                    $textArrayBn = array(
                        'headline_bn' => $request->headline_bn[$k],
                        'text_bn' => $request->textarea_bn[$k]
                    );
                    $textJsonBn = json_encode($textArrayBn);

                    $insert[$count]['body_text_en'] = $textJsonEn;
                    $insert[$count]['body_text_bn'] = $textJsonBn;
                    $insert[$count]['position'] = $k;
                    $insert[$count]['component_type'] = 'text';
                }


                  //accordion component
                if (isset($request->accordion_headline_en[$k])) {

                    $arrayEn = array(
                        'accordion_headline_en' => $request->accordion_headline_en[$k],
                        'accordion_textarea_en' => $request->accordion_textarea_en[$k]
                    );
                    $jsonEn = json_encode($arrayEn);

                    $arrayBn = array(
                        'accordion_headline_bn' => $request->accordion_headline_bn[$k],
                        'accordion_textarea_bn' => $request->accordion_textarea_bn[$k]
                    );
                    $jsonBn = json_encode($arrayBn);

                    $insert[$count]['body_text_en'] = $jsonEn;
                    $insert[$count]['body_text_bn'] = $jsonBn;
                    $insert[$count]['position'] = $k;
                    $insert[$count]['component_type'] = 'accordion';
                }




                $count++;
            }

            RoamingOtherOfferComponents::insert($insert);


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


    public function changeComponentSorting($request) {
        try {

            $positions = $request->position;
            foreach ($positions as $position) {
                $comId = $position[0];
                $new_position = $position[1];
                $update = RoamingOtherOfferComponents::findOrFail($comId);
                $update['position'] = $new_position;
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

      public function componentDelete($comId) {

        try {
            $component = RoamingOtherOfferComponents::findOrFail($comId);


            $component->delete();

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

}
