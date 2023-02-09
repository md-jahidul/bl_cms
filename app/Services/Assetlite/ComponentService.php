<?php

namespace App\Services\Assetlite;

//use App\Repositories\AppServiceProductegoryRepository;

use App\Http\Controllers\AssetLite\ExploreCDetailsController;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

use App\Repositories\ComponentRepository;

class ComponentService
{
    use CrudTrait;
    use FileTrait;

    const APP = 1;
    const VAS = 2;
    const PAGE_TYPE = [
        'app_services' => 'app_services',
        'product_details' => 'product_details'
    ];

    /**
     * @var $componentRepository
     */
    protected $componentRepository;

    /**
     * AppServiceProductService constructor.
     * @param ComponentRepository $componentRepository
     */
    public function __construct(ComponentRepository $componentRepository)
    {
        $this->componentRepository = $componentRepository;
        $this->setActionRepository($componentRepository);
    }

    public function findByType($type)
    {
        return $this->componentRepository->findOneByProperties(['type' => $type]);
    }

    public function componentList($section_id, $pageType)
    {
        return $this->componentRepository->list($section_id, $pageType);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeComponentDetails($data)
    {
        if (request()->hasFile('image_url')) {
            $data['image'] = $this->upload($data['image_url'], 'assetlite/images/app-service/product/details');
        }

        if (request()->filled('other_attr')) {
            $other_attributes = request()->input('other_attr', null);
            $data['other_attributes'] = !empty($other_attributes) ? json_encode($other_attributes) : null;
        }

        if (request()->hasFile('video_url')) {
            $data['video'] = $this->upload($data['video_url'], 'assetlite/video/app-service/product/details');
            $data['other_attributes'] = json_encode(['video_type' => 'uploaded_video']);
        } elseif (request()->filled('video_url')) {
            $data['video'] = request()->input('video_url', null);
            $data['other_attributes'] = json_encode(['video_type' => 'youtube_video']);
        }

        $data['page_type'] = self::PAGE_TYPE['app_services'];

        $results = [];
        if (isset($data['multi_item']) && !empty($data['multi_item'])) {
            $request_multi = $data['multi_item'];
            $item_count = isset($data['multi_item_count']) ? $data['multi_item_count'] : 0;
            for ($i = 1; $i <= $item_count; $i++) {
                foreach ($data['multi_item'] as $key => $value) {
                    $sub_data = [];
                    $check_index = explode('-', $key);
                    if ($check_index[1] == $i) {
                        if (request()->hasFile('multi_item.' . $key)) {
                            $value = $this->upload($value, 'assetlite/images/app-service/product/details');
                        }
                        $results[$i][$check_index[0]] = $value;
                    }
                }
            }
        }

        $data['multiple_attributes'] = json_encode($results);

        $this->save($data);
        return new Response('App Service Component added successfully');
    }

//    protected function imageUpload($data)
//    {
//        return $image;
//    }


    public function componentStore($data, $sectionId, $pageType)
    {
        if (request()->hasFile('image')) {

            if ($pageType == ExploreCDetailsController::PAGE_TYPE) {

                $data['image'] = $this->upload($data['image'], 'assetlite/images/explore_c_details');
            }else {
                
                $data['image'] = $this->upload($data['image'], 'assetlite/images/product_details');
            }
        }

        $results = [];
        if (isset($data['multi_item']) && !empty($data['multi_item'])) {
            $request_multi = $data['multi_item'];
            $item_count = isset($data['multi_item_count']) ? $data['multi_item_count'] : 0;
            for ($i = 1; $i <= $item_count; $i++) {
                foreach ($data['multi_item'] as $key => $value) {
                    $sub_data = [];
                    $check_index = explode('-', $key);
                    if ($check_index[1] == $i) {
                        if (request()->hasFile('multi_item.' . $key)) {
                            if ($pageType == ExploreCDetailsController::PAGE_TYPE) {

                                $value = $this->upload($value, 'assetlite/images/explore_c_details');
                            }else {
                                
                                $value = $this->upload($value, 'assetlite/images/product_details');
                            }
                        }
                        $results[$i][$check_index[0]] = $value;
                    }
                }
            }
        }

        // return count($results);
        $data['multiple_attributes'] = (count($results) >= 1) ? array_values($results) : null;
        $countComponents = $this->componentRepository->list($sectionId, $pageType);
        $data['component_order'] = count($countComponents) + 1;

        $data['page_type'] = $pageType;
        $data['section_details_id'] = $sectionId;

        # other attributes to save
        if (!empty($data['other_attr']) && count($data['other_attr']) > 0) {
            $data['other_attributes'] = $data['other_attr'];
        }

        /**
         * Creator: Shuvo-bs
         * For Button Component 
         * Genareted Html stored in editor_en & editor_bn column
         * 
         */
        // if ($data['component_type'] == 'button_component') {
        //     $check_external = '';
        //     $link_en = '#';
        //     $link_bn = '#';

        //     if (isset($data['other_attributes'] ['is_external_url'])) {

        //         if ($data['other_attributes'] ['is_external_url'] == 1) {
        //             $check_external = 'target="_blank"';
        //             $link_en = $link_bn = (isset($data['other_attributes'] ['external_url'])) ? $data['other_attributes'] ['external_url'] : '';
        //         }

        //     }else{

        //         $link_en = (isset($data['other_attributes'] ['redirect_url_en'])) ? $data['other_attributes'] ['redirect_url_en'] : '';
        //         $link_bn = (isset($data['other_attributes'] ['redirect_url_bn'])) ? $data['other_attributes'] ['redirect_url_bn'] : '';
        //     }

        //     $btn_html_en = '<a class="btn btn-danger" href="'.$link_en.'"'.$check_external.'  >'.$data['title_en'].'</a>';
        //     $btn_html_bn = '<a class="btn btn-danger" href="'.$link_bn.'"'.$check_external.'  >'.$data['title_bn'].'</a>';


        //     $data['editor_en'] = $btn_html_en;
        //     $data['editor_bn'] = $btn_html_bn;
            
        // }

        $this->save($data);
        return response('Component create successfully!');
    }


    public function componentUpdate($data, $id)
    {
        $component = $this->findOne($id);
        if (request()->hasFile('image')) {

            if ($component['page_type'] == ExploreCDetailsController::PAGE_TYPE) {

                $data['image'] = $this->upload($data['image'], 'assetlite/images/explore_c_details');
            }else {

                $data['image'] = $this->upload($data['image'], 'assetlite/images/product_details');
            }
            $this->deleteFile($component->image);
        }

        $results = [];
        if (isset($data['multi_item']) && !empty($data['multi_item'])) {
            $request_multi = $data['multi_item'];
            $item_count = isset($data['multi_item_count']) ? $data['multi_item_count'] : 0;
            for ($i = 1; $i <= $item_count; $i++) {
                foreach ($data['multi_item'] as $key => $value) {
                    // print_r($value);
                    $sub_data = [];
                    $check_index = explode('-', $key);
                    if ($check_index[1] == $i) {
                        if (request()->hasFile('multi_item.' . $key)) {
                            if ($component['page_type'] != ExploreCDetailsController::PAGE_TYPE) {

                                $value = $this->upload($value, 'assetlite/images/product_details');
                            }
                        }
                        $results[$i][$check_index[0]] = $value;
                    }
                }
            }
            // return [$results, $data['multi_item']];
        }

        // get original data
        $new_multiple_attributes = $component->multiple_attributes ?? null;

        //contains all the inputs from the form as an array
        $input_multiple_attributes = isset($results) ? array_values($results) : null;
        // return $data['multi_item'];

        if ($component['page_type'] == ExploreCDetailsController::PAGE_TYPE) {

            $data['multiple_attributes'] = $input_multiple_attributes;

        }else{

            //loop over the product array
            if ($input_multiple_attributes) {
                foreach ($input_multiple_attributes as $data_id => $inputData) {
                    foreach ($inputData as $key => $value) {
                        // set the new value
                        $new_multiple_attributes[$data_id][$key] = $value;
                    }
                }
            }
    
            $data['multiple_attributes'] = $new_multiple_attributes;
        }

        if ($data['component_type'] == 'table_component') {
            $data['editor_en'] = str_replace('class="table table-bordered"', 'class="table table-primary offer_table"', $data['editor_en']);
            $data['editor_bn'] = str_replace('class="table table-bordered"', 'class="table table-primary offer_table"', $data['editor_bn']);
        }

        # other attributes to save
        if (!empty($data['other_attr']) && count($data['other_attr']) > 0) {
            $data['other_attributes'] = $data['other_attr'];
        }

        /**
         * Creator: Shuvo-bs
         * For Button Component 
         * Genareted Html stored in editor_en & editor_bn column
         * 
         */
        // if ($data['component_type'] == 'button_component') {
        //     $check_external = '';
        //     $link_en = '#';
        //     $link_bn = '#';

        //     if (isset($data['other_attributes'] ['is_external_url'])) {

        //         if ($data['other_attributes'] ['is_external_url'] == 1) {
        //             $check_external = 'target="_blank"';
        //             $link_en = $link_bn = (isset($data['other_attributes'] ['external_url'])) ? $data['other_attributes'] ['external_url'] : '';
        //         }

        //     }else{

        //         $link_en = (isset($data['other_attributes'] ['redirect_url_en'])) ? $data['other_attributes'] ['redirect_url_en'] : '';
        //         $link_bn = (isset($data['other_attributes'] ['redirect_url_bn'])) ? $data['other_attributes'] ['redirect_url_bn'] : '';
        //     }

        //     $btn_html_en = '<a class="btn btn-danger" href="'.$link_en.'"'.$check_external.'  >'.$data['title_en'].'</a>';
        //     $btn_html_bn = '<a class="btn btn-danger" href="'.$link_bn.'"'.$check_external.'  >'.$data['title_bn'].'</a>';


        //     $data['editor_en'] = $btn_html_en;
        //     $data['editor_bn'] = $btn_html_bn;

        // }

        $component->update($data);
        // return $data['multiple_attributes'];
        return response("Component update successfully!!");
    }


    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updateAppServiceProduct($data, $id)
    {
        $appServiceProduct = $this->findOne($id);
        if (request()->hasFile('product_img_url')) {
            $data['product_img_url'] = $this->upload($data['product_img_url'], 'assetlite/images/app-service/product/details');
            $this->deleteFile($appServiceProduct->product_img_url);
        }

        // Check App & VAS
        if ($data['app_service_tab_id'] != self::APP || $data['app_service_tab_id'] != self::VAS) {
            $data['product_img_url'] = null;
            $this->deleteFile($appServiceProduct->product_img_url);
        }
        $data['can_active'] = (isset($data['can_active']) ? 1 : 0);

        $appServiceProduct->update($data);
        return Response('App Service Category updated successfully');
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

    /**
     * [attrTableSortable description]
     * @param  [type] $data [description]
     * @return Response [type]       [description]
     */
    public function attrTableSortable($data)
    {
        $this->componentRepository->multiAttrTableSort($data);
        return new Response('update successfully');
    }


    /**
     * [processMultiAttrValue description]
     * @param  [type] $data    [description]
     * @param  [type] $item_id [description]
     * @return [type]          [description]
     */
    public function processMultiAttrValue($data, $item_id)
    {
        $data = json_decode($data);
        $reuslts = null;
        foreach ($data as $value) {
            if ($value->id == $item_id) {
                $reuslts = $value;
            }
        }
        return $reuslts;
    }


    public function storeComponentMultiItemAttr($data)
    {

        $component_id = $data['component_id'];
        $item_id = $data['item_id'];
        $item_data = $data['component_multi_attr'];

        if (empty($component_id) || empty($item_id) || empty($item_data)) {
            return false;
        }

        $component = $this->findOne($component_id);

        // get original data
        $multiple_attributes = !empty($component->multiple_attributes) ? json_decode($component->multiple_attributes, true) : null;

        // loop over the product array
        if (!empty($multiple_attributes)) {
            foreach ($multiple_attributes as $key => $attributes) {
                if ($attributes['id'] == $item_id) {
                    if (isset($item_data['title_en']) && !empty($item_data['title_en'])) {
                        $attributes['title_en'] = $item_data['title_en'];
                    }

                    if (isset($item_data['title_bn']) && !empty($item_data['title_bn'])) {
                        $attributes['title_bn'] = $item_data['title_bn'];
                    }

                    if (isset($item_data['alt_text']) && !empty($item_data['alt_text'])) {
                        $attributes['alt_text'] = $item_data['alt_text'];
                    }

                    if (isset($item_data['status'])) {
                        $attributes['status'] = $item_data['status'];
                    }


                    if (isset($item_data['image_url']) && !empty($item_data['image_url'])) {
                        $attributes['image_url'] = is_object($item_data['image_url']) ? $this->upload($item_data['image_url'], 'assetlite/images/product_details') : $attributes['image_url'];
                    }

                    $multiple_attributes[$key] = $attributes;

                }

            }
        }
        $reults['multiple_attributes'] = !empty($multiple_attributes) ? json_encode($multiple_attributes) : null;
        $component->update($reults);
        return response("Component update successfully!!");
    }

    /**
     * @param $data
     * @return Response
     */
    public function tableSortable($data)
    {
        $this->componentRepository->componentTableSort($data);
        return new Response('update successfully');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function deleteComponent($id)
    {
        $component = $this->findOne($id);

        if($component) $component->delete();
        
        return Response('Component deleted successfully !');
    }


    public function conponentMultiAttrItemDestroy($data)
    {
        $component_id = $data['component_id'];
        $item_id = $data['item_id'];

        if ( empty($component_id) || empty($item_id) ) {
            return false;
        }

        $component = $this->findOne($component_id);
        // get original data
        $multiple_attributes = !empty($component->multiple_attributes) ? json_decode($component->multiple_attributes, true) : null;

        // loop over the product array
        if (!empty($multiple_attributes)) {
            $multi_attr = array_map(function($value) use ($item_id){
                if( $value['id'] == $item_id ){
                    return false;
                }
                return $value;
            }, $multiple_attributes);

            $reults['multiple_attributes'] = !empty($multi_attr) ? json_encode(array_filter($multi_attr)) : null;
            $component->update($reults);
            return response("Component deleted!!");
        }
        else{
            return false;
        }
    }
}
