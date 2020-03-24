<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 20/03/2020
 */

namespace App\Repositories;

use App\Models\RoamingCategory;

class RoamingCategoryRepository extends BaseRepository {

    public $modelName = RoamingCategory::class;

    public function getCategoryList() {
        $categories = $this->model->orderBy('sort')->get();
        return $categories;
    }

    public function getCategory($catId) {
        $categoriy = $this->model->findOrFail($catId);
        return $categoriy;
    }

    public function updateCategory($webPath, $mobilePath, $request) {
        try {

            $category = $this->model->findOrFail($request->cat_id);

            $category->name_en = $request->name_en;
            $category->name_bn = $request->name_bn;
            $category->banner_web = $webPath;
            $category->banner_mobile = $mobilePath;
            $category->alt_text = $request->alt_text;
            $category->url_slug = $request->page_url;
            $category->banner_name = $request->banner_name;
            $category->page_header = $request->html_header;
            $category->schema_markup = $request->schema_markup;
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
