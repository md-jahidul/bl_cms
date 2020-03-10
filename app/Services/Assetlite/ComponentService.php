<?php

namespace App\Services\Assetlite;

//use App\Repositories\AppServiceProductegoryRepository;

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
    const PAGE_TYPE = 'app_services';

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

    public function componentList($section_id)
    {
        return $this->componentRepository->findByProperties(['section_details_id' => $section_id]);
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

        if( request()->filled('other_attr') ){
            $other_attributes = request()->input('other_attr', null);
            $data['other_attributes'] = !empty($other_attributes) ? json_encode($other_attributes) : null;
        }

        if (request()->hasFile('video_url')) {
            $data['video'] = $this->upload($data['video_url'], 'assetlite/video/app-service/product/details');
            $data['other_attributes'] = json_encode(['video_type' => 'uploaded_video']);
        } elseif( request()->filled('video_url') ) {
            $data['video'] = request()->input('video_url', null);
            $data['other_attributes'] = json_encode(['video_type' => 'youtube_video']);
        }

	   $data['page_type'] = self::PAGE_TYPE;

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

    protected function imageUpload($data)
    {

        return $image;
    }



    public function componentStore($data, $sectionId)
    {
//        dd($data);

        if (request()->hasFile('image')) {
            $data['image'] = $this->upload($data['image'], 'assetlite/images/banner/product_details');
        }

//        $input_multiple_attributes = $data['multiple_attributes'];
//
//        // loop over the product array
//        foreach ($input_multiple_attributes as $data_id => $inputData) {
//            foreach ($inputData as $key => $value) {
//                // set the new value
//                $new_multiple_attributes[$data_id][$key] = is_object($value) ? $this->upload($value, 'assetlite/images/product_details') : $value;
//            }
//        }

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



        $data['multiple_attributes'] = array_values($results);

//        ($new_multiple_attributes['alt_text']['alt_text_1']) ? $data['multiple_attributes'] = $new_multiple_attributes : $data['multiple_attributes'] = null;

        $data['page_type'] = "product_details";
        $data['section_details_id'] = $sectionId;
        $this->save($data);
        return response('Component create successfully!');
    }

    public function componentUpdate($data, $id)
    {

        $component = $this->findOne($id);

        // get original data
        $new_multiple_attributes = $component->multiple_attributes;

        // contains all the inputs from the form as an array
        $input_multiple_attributes = isset($data['multiple_attributes']) ? $data['multiple_attributes'] : null;

        // loop over the product array
        if ($input_multiple_attributes) {
            foreach ($input_multiple_attributes as $data_id => $inputData) {
                foreach ($inputData as $key => $value) {
                    // set the new value
                    $new_multiple_attributes[$data_id][$key] = is_object($value) ? $this->upload($value, 'assetlite/images/product_details') : $value;
                }
            }
        }

        if (request()->hasFile('image')) {
            $data['image'] = $this->upload($data['image'], 'assetlite/images/banner/product_details');
        }


        $data['multiple_attributes'] = $new_multiple_attributes;


        $data['page_type'] = "product_details";
        $component->update($data);
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
}
