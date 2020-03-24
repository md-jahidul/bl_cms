<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 20/03/2020
 */

namespace App\Repositories;

use App\Models\RoamingGeneralPages;
use App\Models\RoamingPageComponents;

class RoamingPagesRepository extends BaseRepository {

    public $modelName = RoamingGeneralPages::class;

    public function getPageList() {
        $response = $this->model->get();
        return $response;
    }

    public function getPage($pageId) {
        $response = $this->model->findOrFail($pageId);
        return $response;
    }

    public function getPageComponents($pageId) {
        $response = RoamingPageComponents::where('parent_id', $pageId)->get();
        return $response;
    }

    public function updatePage($request) {
        try {
            if ($request->page_type == 'info-and-tips') {
                
            } else {
                $page = $this->model->findOrFail($request->page_id);
                $page->title_en = $request->title_en;
                $page->title_bn = $request->title_bn;
                $page->save();
            }

            //delete all previous components
            RoamingPageComponents::where(array('page_type' => $request->page_type, 'parent_id' => $request->page_id))->delete();

            $insert = [];

            $count = 0;
            foreach ($request->component_position as $k => $val) {
                $insert[$count]['page_type'] = $request->page_type;
                $insert[$count]['parent_id'] = $request->page_id;

                if (isset($request->feature_title_en[$k])) {
                    $insert[$count]['body_text_en'] = $request->feature_title_en[$k];
                    $insert[$count]['body_text_bn'] = $request->feature_title_bn[$k];
                    $insert[$count]['big_font'] = 0;
                    $insert[$count]['payment_block'] = 0;
                    $insert[$count]['position'] = $k;
                    $insert[$count]['component_type'] = 'feature_title';
                }


                if (isset($request->highlights_title_en[$k])) {
                    $insert[$count]['body_text_en'] = $request->highlights_title_en[$k];
                    $insert[$count]['body_text_bn'] = $request->highlights_title_bn[$k];
                    $insert[$count]['big_font'] = 0;
                    $insert[$count]['payment_block'] = 0;
                    $insert[$count]['position'] = $k;
                    $insert[$count]['component_type'] = 'highlights_title';
                }

                if (isset($request->advance_title_en[$k])) {
                    $insert[$count]['body_text_en'] = $request->advance_title_en[$k];
                    $insert[$count]['body_text_bn'] = $request->advance_title_bn[$k];
                    $insert[$count]['big_font'] = isset($request->advance_title_big_font[$k]) ? 1 : 0;
                    $insert[$count]['payment_block'] = 0;
                    $insert[$count]['position'] = $k;
                    $insert[$count]['component_type'] = 'advance_title';
                }

                if (isset($request->condition_list_en[$k])) {
                    $insert[$count]['body_text_en'] = $request->condition_list_en[$k];
                    $insert[$count]['body_text_bn'] = $request->condition_list_bn[$k];
                    $insert[$count]['big_font'] = 0;
                    $insert[$count]['payment_block'] = isset($request->payment_block[$k]) ? 1 : 0;
                    $insert[$count]['position'] = $k;
                    $insert[$count]['component_type'] = 'condition_list';
                }



                $count++;
            }

            RoamingPageComponents::insert($insert);


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
                $update = $this->model->findOrFail($categoryId);
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

    public function changeHomeShowStatus($catId) {
        try {

            $category = $this->model->findOrFail($catId);

            $status = $category->home_show == 1 ? 0 : 1;
            $category->home_show = $status;
            $category->save();

            $response = [
                'success' => 1,
                'show_status' => $status,
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'errors' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    public function deleteCards($cardId) {
        try {
            if ($cardId > 0) {
                $card = $this->model->findOrFail($cardId);
                $card->delete();
            } else {
                $this->model->truncate();
            }

            $response = [
                'success' => 1
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'errors' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

}
