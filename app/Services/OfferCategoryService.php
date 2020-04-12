<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 26-Aug-19
 * Time: 4:31 PM
 */

namespace App\Services;

use App\Repositories\OfferCategoryRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class OfferCategoryService
{

    use CrudTrait;
    use FileTrait;

    /**
     * @var $offerCategoryRepository
     */
    protected $offerCategoryRepository;

    /**
     * OfferCategoryService constructor.
     * @param OfferCategoryRepository $offerCategoryRepository
     */
    public function __construct(OfferCategoryRepository $offerCategoryRepository)
    {
        $this->offerCategoryRepository = $offerCategoryRepository;
        $this->setActionRepository($offerCategoryRepository);
    }

    /**
     * @param $type
     * @return mixed
     */
    public function getOfferCategories($type)
    {
        return $this->offerCategoryRepository->getList($type);
    }

    public function packageChild()
    {
        return $this->offerCategoryRepository->child();
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeOfferCategory($data)
    {
        $data['alias'] = str_replace(" ", "_", strtolower($data['name']));
        $this->save($data);
        return new Response('Offer category added successfully');
    }

    /**
     * Updating the OfferCategory
     * @param $data
     * @return Response
     */
    public function updateOfferCategory($data, $id)
    {
        try {


            $status = true;
            $update = [];

            $update['name_en'] = $data['name_en'];
            $update['name_bn'] = $data['name_bn'];
            $update['url_slug'] = $data['url_slug'];
            $update['schema_markup'] = $data['schema_markup'];
            $update['page_header'] = $data['page_header'];
            $update['banner_name'] = $data['banner_name'];
            $update['banner_alt_text'] = $data['banner_alt_text'];

            $offerCategory = $this->findOne($id);

//            if (!empty($data['banner_image_url'])) {
//                // $imageUrl = $this->imageUpload($data, "banner_image_url", $data['name_en'], '/uploads/assetlite/images/banner/offer_image');
//                // $data['banner_image_url'] = '/assetlite/images/banner/offer_image/' . $imageUrl;
//                $data['banner_image_url'] = $this->upload($data['banner_image_url'], 'assetlite/images/banner/offer_image');
//            }

            if (!empty($data['banner_image_url'])) {
                //delete old web photo
                if ($data['old_web_img'] != "") {
                    $this->deleteFile($data['old_web_img']);
                }

                $photoName = $data['banner_name'] . '-web';
                $update['banner_image_url'] = $this->upload($data['banner_image_url'], 'assetlite/images/banner/offer_image', $photoName);
                $status = $update['banner_image_url'];


            }

            if (!empty($data['banner_image_mobile'])) {
                //delete old web photo
                if ($data['old_mob_img'] != "") {
                    $this->deleteFile($data['old_mob_img']);
                }

                $photoName = $data['banner_name'] . '-mobile';
                $update['banner_image_mobile'] = $this->upload($data['banner_image_mobile'], 'assetlite/images/banner/offer_image', $photoName);
                $status = $update['banner_image_mobile'];


            }

            //only rename
            if ($data['old_banner_name'] != $data['banner_name']) {

                if (empty($data['banner_image_url']) && $data['old_web_img'] != "") {
                    $fileName = $data['banner_name'] . '-web';
                    $directoryPath = 'assetlite/images/banner/offer_image';
                    $update['banner_image_url'] = $this->rename($data['old_web_img'], $fileName, $directoryPath);
                    $status = $update['banner_image_url'];
                }

                if (empty($data['banner_image_mobile']) && $data['old_mob_img'] != "") {
                    $fileName = $data['banner_name'] . '-mobile';
                    $directoryPath = 'assetlite/images/banner/offer_image';
                    $update['banner_image_mobile'] = $this->rename($data['old_mob_img'], $fileName, $directoryPath);
                    $status = $update['banner_image_mobile'];
                }
            }

            if (!empty($data['alias'])) {
                $data['alias'] = str_replace(" ", "_", strtolower($data['name']));
            }

//            dd($update);

            if ($status != false) {

                $this->offerCategoryRepository->saveCategory($update, $id);

                $response = [
                    'success' => 1,
                ];
            } else {
                $response = [
                    'success' => 2,
                ];
            }

            return $response;
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }

    public function getRelatedProducts()
    {
        return $this->offerCategoryRepository->findOneByProperties(['alias' => 'packages']);
    }

    /**
     * @param $data
     * @return ResponseFactory|Response
     */
    public function storeRelatedProduct($data)
    {
        $offerType = $this->offerCategoryRepository->findOneByProperties(['alias' => 'packages']);
        // get original data
        $new_multiple_attributes = $offerType->other_attributes;

        // contains all the inputs from the form as an array
        $input_other_attributes = isset($data['other_attributes']) ?
            $data['other_attributes'] : [$data['type'] . "_related_product_id" => []];

        // loop over the product array
        if ($input_other_attributes) {
            foreach ($input_other_attributes as $data_id => $inputData) {
                $new_multiple_attributes[$data_id] = $inputData;
            }
        }
        $data['other_attributes'] = $new_multiple_attributes;
        $offerType->update($data);

        return response('Related product save successfully');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function deleteOfferCategory($id)
    {
        $offerCategory = $this->findOne($id);
        $offerCategory->delete();
        return Response('Offer category deleted successfully !');
    }

}
