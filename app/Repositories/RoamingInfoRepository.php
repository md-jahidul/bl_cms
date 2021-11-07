<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 27/03/2020
 */

namespace App\Repositories;

use App\Models\RoamingInfo;
use App\Models\RoamingInfoCategory;
use App\Models\RoamingInfoComponents;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Auth;

class RoamingInfoRepository extends BaseRepository {

    use FileTrait;

    public $modelName = RoamingInfo::class;


    public function getInfo() {
        $response = $this->model
                        ->orderBy('id', 'desc')->get();
        return $response;
    }



    public function getInfoById($infoId) {
        $response = $this->model->findOrFail($infoId);
        return $response;
    }

    public function saveInfo($webPath, $mobilePath, $request) {
        try {

            if ($request->info_id == "") {
                $info = $this->model;
                $info->created_by = Auth::id();
            } else {
                $info = $this->model->findOrFail($request->info_id);
                $info->updated_by = Auth::id();
            }

            $info->name_en = $request->name_en;
            $info->name_bn = $request->name_bn;
            $info->card_text_en = $request->card_text_en;
            $info->card_text_bn = $request->card_text_bn;
            $info->short_text_en = $request->short_text_en;
            $info->short_text_bn = $request->short_text_bn;
            $info->banner_name = $request->banner_name;
            $info->banner_name_bn = $request->banner_name_bn;
            $info->banner_web = $webPath;
            $info->banner_mobile = $mobilePath;
            $info->alt_text = $request->alt_text;
            $info->alt_text_bn = $request->alt_text_bn;
            $info->url_slug = $request->url_slug;
            $info->url_slug_bn = $request->url_slug_bn;
            $info->page_header = $request->html_header;
            $info->page_header_bn = $request->page_header_bn;
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

    public function saveComponents($request) {
        try {


            //delete all previous components
            RoamingInfoComponents::where(array('parent_id' => $request->parent_id))->delete();

            $insert = [];

            $count = 0;
            $photo = [];
            foreach ($request->component_position as $k => $val) {
                $insert[$count]['parent_id'] = $request->parent_id;

                //photo component
                if (isset($request->photo_one[$k]) || isset($request->photo_one_old[$k])) {

                    $photo[] = isset($request->photo_one[$k]) ? $this->upload($request->photo_one[$k], 'assetlite/images/roaming') : $request->photo_one_old[$k];
                    $photo[] = isset($request->photo_two[$k]) ? $this->upload($request->photo_two[$k], 'assetlite/images/roaming') : $request->photo_two_old[$k];
                    $photo[] = isset($request->photo_three[$k]) ? $this->upload($request->photo_three[$k], 'assetlite/images/roaming') : $request->photo_three_old[$k];
                    $photo[] = isset($request->photo_four[$k]) ? $this->upload($request->photo_four[$k], 'assetlite/images/roaming') : $request->photo_four_old[$k];


                    $arrayEn = array(
                        'headline_en' => $request->headline_en[$k],
                        'photos' => $photo
                    );
                    $photo = [];
                    $jsonEn = json_encode($arrayEn);

                    $alt[] = $request->alt_one[$k];
                    $alt[] = $request->alt_two[$k];
                    $alt[] = $request->alt_three[$k];
                    $alt[] = $request->alt_four[$k];

                    $arrayBn = array(
                        'headline_bn' => $request->headline_bn[$k],
                        'alt_text' => $alt
                    );
                    $jsonBn = json_encode($arrayBn);

                    $insert[$count]['body_text_en'] = $jsonEn;
                    $insert[$count]['body_text_bn'] = $jsonBn;

                    $insert[$count]['position'] = $k;
                    $insert[$count]['component_type'] = 'photo';
                }

                //table component
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

                //headline component
                if (isset($request->headline_only_en[$k])) {

                    $arrayEn = array(
                        'headline_only_en' => $request->headline_only_en[$k],
                    );
                    $jsonEn = json_encode($arrayEn);

                    $arrayBn = array(
                        'headline_only_bn' => $request->headline_only_bn[$k],
                    );
                    $jsonBn = json_encode($arrayBn);

                    $insert[$count]['body_text_en'] = $jsonEn;
                    $insert[$count]['body_text_bn'] = $jsonBn;
                    $insert[$count]['position'] = $k;
                    $insert[$count]['component_type'] = 'headline';
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

                //list component
                if (isset($request->list_headline_en[$k])) {

                    $arrayEn = array(
                        'list_headline_en' => $request->list_headline_en[$k],
                        'list_textarea_en' => $request->list_textarea_en[$k]
                    );
                    $jsonEn = json_encode($arrayEn);

                    $arrayBn = array(
                        'list_headline_bn' => $request->list_headline_bn[$k],
                        'list_textarea_bn' => $request->list_textarea_bn[$k]
                    );
                    $jsonBn = json_encode($arrayBn);

                    $insert[$count]['body_text_en'] = $jsonEn;
                    $insert[$count]['body_text_bn'] = $jsonBn;
                    $insert[$count]['position'] = $k;
                    $insert[$count]['component_type'] = 'list';
                }




                $count++;
            }

//            print_r($insert);die();


            RoamingInfoComponents::insert($insert);


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
                $update = RoamingInfoComponents::findOrFail($comId);
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
            $component = RoamingInfoComponents::findOrFail($comId);

            if ($component->component_type == 'photo') {
                $bodyEn = json_decode($component->body_text_en);
                foreach ($bodyEn->photos as $val) {
                    if ($val != "") {

                        $this->deleteFile($val);
                    }
                }
            }

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

    /* ###################################### DONE  ################################################# */
}
