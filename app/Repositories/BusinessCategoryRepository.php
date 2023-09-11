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

    public function getCategoryById($catId) {
        $cat = $this->model->findOrFail($catId);
        return $cat;
    }

    public function saveBannerPhoto($filePath, $altText, $catId) {
        $update = [];
        $update['alt_text'] = $altText;

        if ($filePath != "") {
            $update['banner_photo'] = $filePath;
        }


        $this->model->where('id', $catId)->update($update);
        return $filePath;
    }

    public function changeCategoryName($catId, $type, $name) {
        try {

            $category = $this->model->findOrFail($catId);

            if ($type == 'en') {
                $category->name = $name;
            } else {
                $category->name_bn = $name;
            }
            $category->save();

            $response = [
                'success' => 1,
                'name' => $category->name,
                'name_bn' => $category->name_bn,
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $category = $this->model->findOrFail($catId);
            $response = [
                'success' => 0,
                'name' => $category->name,
                'name_bn' => $category->name_bn,
                'message' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    public function changeCategorySorting($request) {
        try {

            $positions = $request->position;
            foreach ($positions as $position) {
                $categoryId = $position[0];
                $new_position = $position[1];
                $update = $this->model->findOrFail($categoryId);
                $update['home_sort'] = $new_position;
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
