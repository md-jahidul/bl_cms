<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Repositories;

use App\Models\BusinessCategory;

class BusinessCategoryRepository extends BaseRepository {

    public $modelName = BusinessCategory::class;

    public function getCategoryList() {
        $categories = $this->model->orderBy('home_sort')->get();
        return $categories;
    }

  


    public function changeCategoryName($catId, $name) {
        try {

            $category = $this->model->findOrFail($catId);

            $category->name = $name;
            $category->save();

            $response = [
                'success' => 1,
                'name' => $category->name
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $category = $this->model->findOrFail($catId);
            $response = [
                'success' => 0,
                'name' => $category->name,
                'message' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    public function changeCategorySorting($catId, $sort) {
        try {

            $category = $this->model->findOrFail($catId);

            $category->home_sort = $sort;
            $category->save();

            $response = [
                'success' => 1,
                'sort' => $category->home_sort
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $category = $this->model->findOrFail($catId);
            $response = [
                'success' => 0,
                'sort' => $category->home_sort,
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
