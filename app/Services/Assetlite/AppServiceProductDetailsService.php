<?php

namespace App\Services\Assetlite;

//use App\Repositories\AppServiceProductegoryRepository;

use App\Repositories\AppServiceProductDetailsRepository;
use App\Repositories\ComponentMultiDataRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Repositories\ComponentRepository;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AppServiceProductDetailsService
{
    use CrudTrait;
    use FileTrait;

    const PAGE_TYPE = 'app_services';


    /**
     * @var $appServiceProductDetailsRepository
     */
    protected $appServiceProductDetailsRepository;
    /**
     * @var AppServiceProductDetailsRepository
     */

    /**
     * @var $componentRepository
     */
    protected $componentRepository;
    /**
     * @var ComponentMultiDataRepository
     */
    private $comMultiDataRepository;


    /**
     * AppServiceProductService constructor.
     * @param AppServiceProductDetailsRepository $appServiceProductDetailsRepository
     * @param ComponentRepository $componentRepository
     * @param ComponentMultiDataRepository $componentMultiDataRepository
     */
    public function __construct(
        AppServiceProductDetailsRepository $appServiceProductDetailsRepository,
        ComponentRepository $componentRepository,
        ComponentMultiDataRepository $componentMultiDataRepository
    )
    {
        $this->appServiceProductDetailsRepository = $appServiceProductDetailsRepository;
        $this->componentRepository = $componentRepository;
        $this->comMultiDataRepository = $componentMultiDataRepository;
        $this->setActionRepository($appServiceProductDetailsRepository);
    }

    public function sectionList($product_id)
    {
        $data = [];
        $data['section_body'] = $this->appServiceProductDetailsRepository->findSection($product_id);
        $data['fixed_section'] = $this->appServiceProductDetailsRepository->fixedSection($product_id);
        return $data;
    }

    public function bindTableComponent()
    {
        $request = request();
        $insert = [];
        $count = 0;

//        dd($request->all());

        if ($request->component_position) {
            foreach ($request->component_position as $k => $val) {
                if (isset($request->left_head_en[$k]) || isset($request->right_head_en[$k])) {
                    $bothTableArrayEn = array(
                        'left_head_en' => $request->left_head_en[$k],
                        'left_rows_en' => $request->left_col_en[$k],
                        'left_table_title_en' => $request->left_table_title_en,
                    );

                    if ($request->right_head_en[$k]) {
                        if (!empty(array_filter($request->right_head_en[$k]))) {
                            $bothTableArrayEn['right_head_en'] = $request->right_head_en[$k];
                            $bothTableArrayEn['right_rows_en'] = $request->right_col_en[$k];
                            $bothTableArrayEn['right_table_title_en'] = $request->right_table_title_en;
                        }
                    }


                    $bothTableArrayBn = array(
                        'left_head_bn' => $request->left_head_bn[$k],
                        'left_rows_bn' => $request->left_col_bn[$k],
                        'left_table_title_bn' => $request->left_table_title_bn,
                    );

                    if ($request->right_head_bn[$k]) {
                        if (!empty(array_filter($request->right_head_bn[$k]))) {
                            $bothTableArrayBn['right_head_bn'] = $request->right_head_bn[$k];
                            $bothTableArrayBn['right_rows_bn'] = $request->right_col_bn[$k];
                            $bothTableArrayBn['right_table_title_bn'] = $request->right_table_title_bn;
                        }
                    }
                }
                $insert[$count]['editor_en'] = json_encode($bothTableArrayEn);
                $insert[$count]['editor_bn'] = json_encode($bothTableArrayBn);
            }
            return $insert[$count];
        }
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeAppServiceProductDetails($data, $tab_type, $product_id)
    {
        # Save sections data
        $sections_data = $data['sections'];

        $sections_data['product_id'] = $product_id;
        $sections_data['section_order'] = 99;

        if (isset($data['component_title_en']) && isset($data['component_title_bn'])) {
            $sections_data['title_en'] = $data['component_title_en'];
            $sections_data['title_bn'] = $data['component_title_bn'];
        }

        $sections_saved_data = $this->save($sections_data);

        if (isset($sections_saved_data->id) && !empty($sections_saved_data->id)) {
            # Save Component data
            $component_data = $data['component'];

            if (!empty($component_data) && count($component_data) > 0) {
                foreach ($component_data as $key => $value) {

                    $value['section_details_id'] = $sections_saved_data->id;
                    $value['page_type'] = self::PAGE_TYPE;

                    if (request()->hasFile('component.' . $key . '.image_url')) {
                        $value['image'] = $this->upload($data['component'][$key]['image_url'], 'assetlite/images/app-service/product-details');
                    }


                    # get video url
                    if (isset($value['video_url']) && is_object($value['video_url'])) {
                        $value['video'] = $this->upload($value['video_url'], 'assetlite/images/app-service/product/details');
                    } elseif (isset($value['video_url'])) {
                        $value['video'] = $value['video_url'];
                    }
                    # Multiple item to save
                    if (request()->filled('component.' . $key . '.multi_item')) {
                        $request_multi = $value['multi_item'];
                        if (!isset($request_multi['status-1'])) {
                            $request_multi['status-1'] = "1";
                        }
                        $item_count = isset($value['multi_item_count']) ? $value['multi_item_count'] : 0;
                        $results = [];
                        for ($i = 1; $i <= $item_count; $i++) {
                            foreach ($request_multi as $m_key => $m_value) {
                                $sub_data = [];
                                $check_index = explode('-', $m_key);
                                if ($check_index[1] == $i) {
                                    if (request()->hasFile('component.' . $key . '.multi_item.' . $m_key)) {
                                        // dd( request()->hasFile('component.'.$key.'.multi_item.'.$m_key) );
                                        $m_value = $this->upload($data['component'][$key]['multi_item'][$m_key], 'assetlite/images/app-service/product/details');
                                    }
                                    $results[$i][$check_index[0]] = ($m_value != null) ? $m_value : '';

                                }
                            }
                        }
                        $value['multiple_attributes'] = !empty($results) ? json_encode($results) : null;
                    }


                    # Image With Content Component ====
                    if(isset($value['image_with_content_item'])){
                        $request_multi = $value['image_with_content_item'];
                        if (!isset($request_multi['status-1'])) {
                            $request_multi['status-1'] = "1";
                        }
                        $item_count = isset($value['multi_item_count']) ? $value['multi_item_count'] : 0;
                        $results = [];
                        for ($i = 1; $i <= $item_count; $i++) {
                            foreach ($request_multi as $m_key => $m_value) {
                                $sub_data = [];
                                $check_index = explode('-', $m_key);
                                if ($check_index[1] == $i) {
                                    if (isset($request_multi['image_url-'.$i]) && $m_key == 'image_url-'.$i) {
                                        $m_value = $this->upload($data['component'][$key]['image_with_content_item'][$m_key], 'assetlite/images/app-service/product/details');
                                    }
                                    $results[$i][$check_index[0]] = ($m_value != null) ? $m_value : '';

                                }
                            }
                        }
                        $value['multiple_attributes'] = !empty($results) ? json_encode($results) : null;
                    }

                    # Multi Tab With Image Component ====
                    if(isset($value['multi_tab_item'])){
                        $tabData = [];
                        $request_multi = $value['multi_tab_item'];
                        foreach($request_multi as $k => $tab){
                            $item_count = isset($tab['sub_item_count']) ? $tab['sub_item_count'] : 0;
                            $results = [];
                            for ($i = 1; $i <= $item_count; $i++) {
                                foreach ($tab as $m_key => $m_value) {
                                    $sub_data = [];
                                    $check_index = explode('-', $m_key);
                                    if (isset($check_index[1]) && $check_index[1] == $i) {
                                        if (isset($tab['image_url-'.$i]) && $m_key == 'image_url-'.$i) {
                                            $m_value = $this->upload($data['component'][$key]['multi_tab_item'][$k][$m_key], 'assetlite/images/app-service/product/details');
                                        }
                                        $results[$i][$check_index[0]] = ($m_value != null) ? $m_value : '';

                                    }else{
                                        $results[$i][$check_index[0]] = ($m_value != null) ? $m_value : '';
                                    }
                                }
                            }
                            $tabData[$k] = $results;
                        }
                        $value['multiple_attributes'] = !empty($tabData) ? json_encode($tabData) : null;
                    }

                    # other attributes to save
                    if (!empty($value['other_attr']) && count($value['other_attr']) > 0) {
                        $value['other_attributes'] = json_encode($value['other_attr']);
                    }

                    $tableComponent = $this->bindTableComponent();
                    if (isset($tableComponent)) {
                        $value['editor_en'] = $tableComponent['editor_en'];
                        $value['editor_bn'] = $tableComponent['editor_bn'];
                    }
                    $component = $this->componentRepository->save($value);

                    if ($value['component_type'] == "multiple_image_banner" || $value['component_type'] == "slider_text_with_image_right" && isset($data['base_image'])) {
                        foreach ($data['base_image'] as $key => $img) {
                            if (!empty($img)) {
                                $baseImgUrl = $this->upload($img, 'assetlite/images/component');
                            }
                            $imgData = [
                                'component_id' => $component->id,
                                'page_type' => $value['page_type'],
                                'title_en' => isset($data['multi_title_en']) ? $data['multi_title_en'][$key] : '',
                                'title_bn' => isset($data['multi_title_bn']) ? $data['multi_title_bn'][$key] : '',
                                'details_en' => isset($data['details_en']) ? $data['details_en'][$key] : '',
                                'details_bn' => isset($data['details_bn']) ? $data['details_bn'][$key] : '',
                                'alt_text_en' => $data['multi_alt_text_en'][$key],
                                'alt_text_bn' => $data['multi_alt_text_bn'][$key],
                                'img_name_en' => str_replace(' ', '-', strtolower($data['img_name_en'][$key])),
                                'img_name_bn' => str_replace(' ', '-', strtolower($data['img_name_bn'][$key])),
                                'base_image' => $baseImgUrl,
                                'created_by' => Auth::id(),
                            ];
                            $this->comMultiDataRepository->save($imgData);
                        }
                    }
                }
            }


            return new Response('App Service details section component added successfully');
        } else {
            return new Response('Something went wrong! App Service details section component not added');
        }
    }

    /**
     * [updateAppServiceDetailsComponent description]
     * @param $data
     * @param $compoent_id
     * @param null $key
     * @return void [type]              [description]
     */
    public function updateAppServiceDetailsComponent($data, $compoent_id, $request, $key = null)
    { 
        $component = $this->componentRepository->findOne($compoent_id);
        if (isset($data['image_url']) && !empty($data['image_url'])) {
            $data['image'] = $this->upload($data['image_url'], 'assetlite/images/app-service/product-details');
        }

        if (isset($data['other_attr']) && !empty($data['other_attr'])) {
            $data['other_attributes'] = json_encode($data['other_attr']);
        }

        if (isset($data['multi_item']) && !empty($data['multi_item'])) {
            $request_multi = $data['multi_item'];
            $item_count = isset($data['multi_item_count']) ? $data['multi_item_count'] : 0;
            $results = [];
            for ($i = 1; $i <= $item_count; $i++) {
                foreach ($request_multi as $m_key => $m_value) {
                    $sub_data = [];
                    $check_index = explode('-', $m_key);

                    if ($check_index[1] == $i) {
                        if (request()->hasFile('component.' . $key . '.multi_item.' . $m_key)) {
                            $m_value = $this->upload($data['multi_item'][$m_key], 'assetlite/images/app-service/product/details');
                        }

                        $results[$i][$check_index[0]] = ($m_value != null) ? $m_value : '';

                    }
                }
            }

            if (request()->input('update') == 'full_update_multi_attr') {
                $final_results = $results;
            } else {
                # get existing multiattr data
                $existing_multi_data = $component->multiple_attributes;

                if (!empty($existing_multi_data)) {
                    $existing_multi_data = json_decode($existing_multi_data, true);

                    $last_array_id = end($existing_multi_data)['id'];
                    $last_display_order_id = end($existing_multi_data)['display_order'];

                    $new_results = array_map(function ($value) use ($last_array_id, $last_display_order_id) {

                        $value['id'] = ($value['id'] + $last_array_id);
                        $value['display_order'] = $value['id'];

                        return $value;

                    }, $results);

                }

                $final_results = array_merge($existing_multi_data, $new_results);
            }

            $data['multiple_attributes'] = !empty($final_results) ? json_encode($final_results) : null;
        }

        # Image With Content Component ====
        if(isset($data['image_with_content_item'])){

            $request_multi = $data['image_with_content_item'];
            if (!isset($request_multi['status-1'])) {
                $request_multi['status-1'] = "1";
            }
            $item_count = isset($data['multi_item_count']) ? $data['multi_item_count'] : 0;
            $results = [];
            for ($i = 1; $i <= $item_count; $i++) {
                foreach ($request_multi as $m_key => $m_value) {
                    $sub_data = [];
                    $check_index = explode('-', $m_key);
                    if ($check_index[1] == $i) {
                        if (isset($request_multi['image_url-'.$i]) && $m_key == 'image_url-'.$i) {
                            $m_value = $this->upload($data['image_with_content_item'][$m_key], 'assetlite/images/app-service/product/details');
                        }
                        $results[$i][$check_index[0]] = ($m_value != null) ? $m_value : '';

                        if(!isset($request_multi['image_url-'.$i]) && $m_key == 'prev_image_url-'.$i) {
                            $results[$i]['image_url'] = $data['image_with_content_item']['prev_image_url-'.$i];
                        }
                    }
                    //$results[$i][$check_index[0]] = $data['image_with_content_item']['display_order-'.$i];
                }
            }
            $data['multiple_attributes'] = !empty($results) ? json_encode($results) : null;
        }

        # Multi Tab With Image Component ====
        if(isset($data['multi_tab_item'])){
            $tabData = [];
            $request_multi = $data['multi_tab_item'];
            foreach($request_multi as $k => $tab){
                $item_count = isset($tab['sub_item_count']) ? $tab['sub_item_count'] : 0;
                $results = [];
                for ($i = 1; $i <= $item_count; $i++) {
                    foreach ($tab as $m_key => $m_value) {
                        $sub_data = [];
                        $check_index = explode('-', $m_key);
                        if (isset($check_index[1]) && $check_index[1] == $i) {
                            if (isset($tab['image_url-'.$i]) && $m_key == 'image_url-'.$i) {
                                $m_value = $this->upload($data['multi_tab_item'][$k][$m_key], 'assetlite/images/app-service/product/details');
                            }
                            $results[$i][$check_index[0]] = ($m_value != null) ? $m_value : '';

                            if(!isset($tab['image_url-'.$i]) && $m_key == 'prev_image_url-'.$i) {
                                $results[$i]['image_url'] = $data['multi_tab_item'][$k]['prev_image_url-'.$i];
                            }

                        }else{
                            $results[$i][$check_index[0]] = ($m_value != null) ? $m_value : '';
                        }
                    }
                } 
                $tabData[$k] = $results;
            }
            $data['multiple_attributes'] = !empty($tabData) ? json_encode($tabData) : null;
        }
        # get video url
        if (isset($data['video_url']) && is_object($data['video_url'])) {
            $data['video'] = $this->upload($data['video_url'], 'assetlite/images/app-service/product/details');
        } elseif (isset($data['video_url'])) {
            $data['video'] = $data['video_url'];
        }


        $tableComponent = $this->bindTableComponent();
        if (isset($tableComponent)) {
            $data['editor_en'] = $tableComponent['editor_en'];
            $data['editor_bn'] = $tableComponent['editor_bn'];
        }
        $component->update($data);
        if ($request['component_type'] == "multiple_image_banner" || $request['component_type'] == "slider_text_with_image_right") {
            $this->comMultiDataRepository->deleteAllById($compoent_id);
            foreach ($request['base_image'] as $key => $img) {
                if (is_object($img)) {
                    $img = $this->upload($img, 'assetlite/images/component');
                    $filePath = isset($data['old_img_url'][$key]) ? $data['old_img_url'][$key] : null;
                    $this->deleteFile($filePath);
                }
                $imgData = [
                    'component_id' => $compoent_id,
                    'page_type' => 'app_services',
                    'title_en' => isset($request['multi_title_en']) ? $request['multi_title_en'][$key] : null,
                    'title_bn' => isset($request['multi_title_bn']) ? $request['multi_title_bn'][$key] : null,
                    'details_en' => isset($request['details_en']) ? $request['details_en'][$key] : null,
                    'details_bn' => isset($request['details_bn']) ? $request['details_bn'][$key] : null,
                    'alt_text_en' => $request['multi_alt_text_en'][$key],
                    'alt_text_bn' => $request['multi_alt_text_bn'][$key],
                    'img_name_en' => str_replace(' ', '-', strtolower($request['img_name_en'][$key])),
                    'img_name_bn' => str_replace(' ', '-', strtolower($request['img_name_bn'][$key])),
                    'base_image' => $img,
                    'updated_by' => Auth::id()
                ];
                $this->comMultiDataRepository->save($imgData);
            }
        }
    }


    public function getSectionColumnInfoByID($section_id, $column_names = [])
    {
        return $this->appServiceProductDetailsRepository->findOneByProperties(['id' => $section_id], $column_names);
    }


    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updateAppServiceDetailsSection($data, $id)
    {
        $appServiceProduct = $this->findOne($id);
        $data['title_en'] = request()->component_title_en;
        $data['title_bn'] = request()->component_title_bn;
        $appServiceProduct->update($data);
        return Response('App Service Section updated successfully');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function deleteAppServiceProduct($id)
    {
        $appServiceCat = $this->findOne($id);
        $this->deleteFile($appServiceCat->product_img_url);
        $appServiceCat->delete();
        return Response('App Service Tab deleted successfully !');
    }

    public function fixedSectionUpdate($data, $tab_type, $product_id)
    {
        if (!empty($data['image'])) {
            //delete old web photo
            if ($data['old_web_img'] != "") {
                $this->deleteFile($data['old_web_img']);
            }
            $photoName = $data['banner_name'] . '-web';
            $data['image'] = $this->upload($data['image'], 'assetlite/images/app-service/product-details', $photoName);
        }

        if (!empty($data['banner_image_mobile'])) {
            //delete old mob photo
            if ($data['old_mob_img'] != "") {
                $this->deleteFile($data['old_mob_img']);
            }
            $photoName = $data['banner_name'] . '-mobile';
            $data['banner_image_mobile'] = $this->upload($data['banner_image_mobile'], 'assetlite/images/app-service/product-details', $photoName);
        }

        //only rename
        if ($data['old_banner_name'] != $data['banner_name']) {
//            dd($data);
            if (empty($data['image']) && $data['old_web_img'] != "") {
                $fileName = $data['banner_name'] . '-web';
                $directoryPath = 'assetlite/images/app-service/product-details';
                $data['image'] = $this->rename($data['old_web_img'], $fileName, $directoryPath);
            }
            if (empty($data['banner_image_mobile']) && $data['old_mob_img'] != "") {
                $fileName = $data['banner_name'] . '-mobile';
                $directoryPath = 'assetlite/images/app-service/product-details';
                $data['banner_image_mobile'] = $this->rename($data['old_mob_img'], $fileName, $directoryPath);
            }
        }

        unset($data['old_web_img']);
        unset($data['old_mob_img']);
        unset($data['old_banner_name']);

//        dd($data);
//        if (request()->hasFile('image')) {
//            $data['image'] = $this->upload($data['image'], 'assetlite/images/app-service/product-details');
//        }
//        if (request()->hasFile('other_attributes.image_mobile')) {
//            $data['other_attributes']['image_mobile'] = $this->upload($data['other_attributes']['image_mobile'], 'assetlite/images/app-service/product-details');
//        }


        $data['tab_type'] = $tab_type;
        $data['product_id'] = $product_id;

        $findFixedSection = $this->appServiceProductDetailsRepository->checkFixedSection($product_id);


        if (!$findFixedSection) {
            $this->save($data);
        } else {
            if (!isset($data['other_attributes'])) {
                $data['other_attributes'] = null;
            }

//            dd($data);

            $findFixedSection->update($data);
        }
        return Response('App Service Section Update Successfully');
    }


    /**
     * [getJsonSectionComponentList description]
     * @param  [type] $product_id [description]
     * @return [type]             [description]
     */
    public function getJsonSectionComponentList($section_id)
    {

        $results = [];

        $section_list_component = $this->appServiceProductDetailsRepository->findSectionEdit($section_id);

        $results['sections'] = $section_list_component;

        if (!empty($section_list_component->sectionComponent) && count($section_list_component->sectionComponent) > 0) {
            foreach ($section_list_component->sectionComponent as $key => $value) {
                $results['component'][] = $value;
                //dd(json_decode($value->multiple_attributes));
                if (isset($value->multiple_attributes) && !empty($value->multiple_attributes)) {
                    $res = json_decode($value->multiple_attributes, true);

                    usort($res, function ($a, $b) {
                        if(isset($a["display_order"]) && isset($b["display_order"])){
                            return strcmp($a["display_order"], $b["display_order"]);
                        }
                    });

                    $results['component'][$key]['multiple_attributes'] = json_encode($res);
                }

                if (isset($value->other_attributes) && !empty($value->other_attributes)) {
                    $other_res = json_decode($value->other_attributes, true);
                    if (!empty($other_res) && count($other_res) > 0) {
                        foreach ($other_res as $other_key => $other_value) {
                            $results['component'][$key][$other_key] = $other_value;
                        }
                    }

                }
                # get component type
                $results['primary_component_type'] = $value->component_type;
            } // end foreach
        }

        return $results;
    }

    /**
     * [getSectionComponentByID description]
     * @param  [type] $section_id [description]
     * @return [type]             [description]
     */
    public function getSectionComponentByID($section_id)
    {

        return $this->appServiceProductDetailsRepository->findOne($section_id, 'sectionComponent');

    }

    /**
     * [tableSortable description]
     * @return [type] [description]
     */
    public function tableSortable($data)
    {
        $this->appServiceProductDetailsRepository->sectionsTableSort($data);
        return new Response('update successfully');
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function sectionDelete($id)
    {
        $section = $this->findOne($id);
        $data['deleted_at'] = Carbon::now();
        $section->update($data);

        //$this->appServiceProductDetailsRepository->sectionItemSoftDeleteBySectionID($id);

        return Response('Section deleted successfully !');
    }

}
