<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 20/03/2020
 */

namespace App\Repositories;

use App\Models\RoamingCategory;
use Illuminate\Support\Facades\Auth;

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
            $category = $this->model->findOrFail($request->cat_id);

            $category->name_en = $request->name_en;
            $category->name_bn = $request->name_bn;
            $category->banner_web = $webPath;
            $category->banner_mobile = $mobilePath;

            $category->banner_title_en = $request->banner_title_en;
            $category->banner_title_bn = $request->banner_title_bn;
            $category->banner_desc_en = $request->banner_desc_en;
            $category->banner_desc_bn = $request->banner_desc_bn;

            $category->alt_text = $request->alt_text;
            $category->alt_text_bn = $request->alt_text_bn;
            $category->url_slug = $request->page_url;
            $category->url_slug_bn = $request->page_url_bn;
//            $category->banner_name = $request->banner_name;
//            $category->banner_name_web_bn = $request->banner_name_web_bn;
//            $category->banner_name_mobile_en = $request->banner_name_mobile_en;
//            $category->banner_name_mobile_bn = $request->banner_name_mobile_bn;
            $category->page_header = $request->html_header;
            $category->page_header_bn = $request->page_header_bn;
            $category->schema_markup = $request->schema_markup;
            $category->status = $request->status;
            $category->updated_by = Auth::id();

            $category->save();
            return $category;
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
