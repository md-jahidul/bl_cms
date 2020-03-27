<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 27/03/2020
 */

namespace App\Repositories;

use App\Models\RoamingInfo;
use App\Models\RoamingInfoCategory;
use App\Models\RoamingInfoComponents;

class RoamingInfoRepository extends BaseRepository {

    public $modelName = RoamingInfo::class;
    
    
     public function getCategoryList() {
        $categories = RoamingInfoCategory::orderBy('sort')->get();
        return $categories;
    }
    
       public function getInfo() {
        $response = $this->model->select('roaming_info_tips.*', 'c.name_en as category_name')
                        ->leftJoin('roaming_info_tips_category as c', 'c.id', '=', 'roaming_info_tips.category_id')
                        ->orderBy('roaming_info_tips.id', 'desc')->get();
        return $response;
    }

    public function getCategory($catId) {
        $categoriy = RoamingInfoCategory::findOrFail($catId);
        return $categoriy;
    }

    public function updateCategory($request) {
        try {

            if ($request->cat_id != "") {
                $category = RoamingInfoCategory::findOrFail($request->cat_id);
            } else {
                $category = new RoamingInfoCategory();
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
                $update = RoamingInfoCategory::findOrFail($categoryId);
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
    
     public function getInfoById($infoId) {
        $response = $this->model->findOrFail($infoId);
        return $response;
    }
    
     public function saveInfo($webPath, $mobilePath, $request) {
        try {

            if ($request->info_id == "") {
                $info = $this->model;
            } else {
                $info = $this->model->findOrFail($request->info_id);
            }

            $info->category_id = $request->category_id;
            $info->name_en = $request->name_en;
            $info->name_bn = $request->name_bn;
            $info->card_text_en = $request->card_text_en;
            $info->card_text_bn = $request->card_text_bn;
            $info->short_text_en = $request->short_text_en;
            $info->short_text_bn = $request->short_text_bn;
            $info->banner_name = $request->banner_name;
            $info->banner_web = $webPath;
            $info->banner_mobile = $mobilePath;
            $info->alt_text = $request->alt_text;
            $info->url_slug = $request->url_slug;
            $info->page_header = $request->html_header;
            $info->schema_markup = $request->schema_markup;
            $info->status = $request->status;
            $info->save();

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
    
      public function deleteInfo($infoId) {
        try {
            $this->model->findORFail($infoId)->delete();
            RoamingInfoComponents::where('parent_id', $infoId)->delete();
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
    
     public function getInfoComponents($infoId) {
        $response = RoamingInfoComponents::where('parent_id', $infoId)->orderBy('position')->get();
        return $response;
    }
    
     /*###################################### DONE  #################################################*/
    
    
    
    
    
    
    
    
    
    

   

    

 

   

   

  

   

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

}
