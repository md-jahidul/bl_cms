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
        $response = RoamingPageComponents::where('parent_id', $pageId)->orderBy('position')->get();
        return $response;
    }

    public function updatePage($request)
    {
            $page = $this->model->findOrFail($request->page_id);

            if ($request->page_type == 'info-and-tips') {

            } else {

                $page->title_en = $request->title_en;
                $page->title_bn = $request->title_bn;
                $page->short_description_en = $request->short_description_en;
                $page->short_description_bn = $request->short_description_bn;
                $page->url_slug_en = $request->url_slug_en;
                $page->url_slug_bn = $request->url_slug_bn;
                $page->page_header_en = $request->page_header_en;
                $page->page_header_bn = $request->page_header_bn;
                $page->schema_markup = $request->schema_markup;
                $page->save();
            }

            //delete all previous components
            RoamingPageComponents::where(array('page_type' => $request->page_type, 'parent_id' => $request->page_id))->delete();

            $insert = [];
            $count = 0;
            foreach ($request->component_position as $k => $val) {
                $insert[$count]['page_type'] = $request->page_type;
                $insert[$count]['parent_id'] = $request->page_id;

                if (isset($request->headline_text_title_en[$k])) {
                    $insert[$count]['headline_en'] = $request->headline_text_title_en[$k];
                    $insert[$count]['headline_bn'] = $request->headline_text_title_bn[$k];
                    $insert[$count]['body_text_en'] = $request->headline_text_textarea_en[$k];
                    $insert[$count]['body_text_bn'] = $request->headline_text_textarea_bn[$k];
                    $insert[$count]['show_button'] = isset($request->show_button[$k]) ? 1 : 0;
                    $insert[$count]['position'] = $k;
                    $insert[$count]['component_type'] = 'headline-text';
                }
                if (isset($request->list_headline_en[$k])) {
                    $insert[$count]['headline_en'] = $request->list_headline_en[$k];
                    $insert[$count]['headline_bn'] = $request->list_headline_bn[$k];
                    $insert[$count]['body_text_en'] = $request->list_textarea_en[$k];
                    $insert[$count]['body_text_bn'] = $request->list_textarea_bn[$k];
                    $insert[$count]['show_button'] = 0;
                    $insert[$count]['position'] = $k;
                    $insert[$count]['component_type'] = 'list-component';
                }
                if (isset($request->free_textarea_en[$k])) {
                    $insert[$count]['headline_en'] = "";
                    $insert[$count]['headline_bn'] = "";
                    $insert[$count]['body_text_en'] = $request->free_textarea_en[$k];
                    $insert[$count]['body_text_bn'] = $request->free_textarea_bn[$k];
                    $insert[$count]['show_button'] = 0;
                    $insert[$count]['position'] = $k;
                    $insert[$count]['component_type'] = 'free-text';
                }
                $count++;
            }

        RoamingPageComponents::insert($insert);
        return $page;
    }

    public function changeComponentSorting($request) {
        try {

            $positions = $request->position;
            foreach ($positions as $position) {
                $comId = $position[0];
                $new_position = $position[1];
                $update = RoamingPageComponents::findOrFail($comId);
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

    public function deleteComponent($comId) {

        try {

            RoamingPageComponents::findOrFail($comId)->delete();

            $response = [
                'success' => 1,
                'message' => 'Success',
            ];
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage()
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

}
