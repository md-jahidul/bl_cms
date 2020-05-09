<?php

namespace App\Services\Assetlite;

//use App\Repositories\AppServiceProductegoryRepository;

use App\Repositories\AppServiceProductDetailsRepository;
use App\Repositories\ComponentRepository;
use App\Repositories\ProductDetailsSectionRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class ProductDetailsSectionService
{
    use CrudTrait;
    use FileTrait;
    /**
     * @var $productDetailsSectionRepository
     */
    protected $productDetailsSectionRepository;

    /**
     * @var $componentRepository
     */
    protected $componentRepository;


    /**
     * ProductDetailsSectionService constructor.
     * @param ProductDetailsSectionRepository $productDetailsSectionRepository
     * @param ComponentRepository $componentRepository
     */
    public function __construct(
        ProductDetailsSectionRepository $productDetailsSectionRepository,
        ComponentRepository $componentRepository
    ) {
        $this->productDetailsSectionRepository = $productDetailsSectionRepository;
        $this->componentRepository = $componentRepository;
        $this->setActionRepository($productDetailsSectionRepository);
    }

    public function findBySection($productId)
    {
        return $this->productDetailsSectionRepository->productDetailsSection($productId);
    }

    /**
     * @param $data
     * @return Response
     */
    public function tableSortable($data)
    {
        $this->productDetailsSectionRepository->sectionTableSort($data);
        return new Response('update successfully');
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeAppServiceProductDetails($data, $tab_type, $product_id)
    {
        $data['product_id'] = $product_id;
        $data['tab_type'] = $tab_type;
        $this->save($data);
        return new Response('App Service details section added successfully');
    }

    public function sectionStore($data)
    {
        if (!empty($data['banner_image_web'])) {
            $photoName = $data['banner_name'] . '-web';
            $data['banner_image_web'] = $this->upload($data['banner_image_web'], 'assetlite/images/banner/product_details', $photoName);
        }

        if (!empty($data['banner_image_mobile'])) {
            $photoName = $data['banner_name'] . '-mobile';
            $data['banner_image_mobile'] = $this->upload($data['banner_image_mobile'], 'assetlite/images/banner/product_details', $photoName);
        }

        $this->save($data);
        return response('Section create successfully!');
    }

    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function sectionUpdate($data, $id)
    {
        $section = $this->findOne($id);


        if (!empty($data['banner_image_web'])) {
            //delete old web photo
            if ($data['old_web_img'] != "") {
                $this->deleteFile($data['old_web_img']);
            }
            $photoName = $data['banner_name'] . '-web';
            $data['banner_image_web'] = $this->upload($data['banner_image_web'], 'assetlite/images/banner/product_details', $photoName);
        }

        if (!empty($data['banner_image_mobile'])) {
            //delete old web photo
            if ($data['old_mob_img'] != "") {
                $this->deleteFile($data['old_mob_img']);
            }

            $photoName = $data['banner_name'] . '-mobile';
            $data['banner_image_mobile'] = $this->upload($data['banner_image_mobile'], 'assetlite/images/banner/product_details', $photoName);
        }

        //only rename
        if ($data['old_banner_name'] != $data['banner_name']) {
            if (empty($data['banner_image_web']) && $data['old_web_img'] != "") {
                $fileName = $data['banner_name'] . '-web';
                $directoryPath = 'assetlite/images/banner/product_details';
                $data['banner_image_web'] = $this->rename($data['old_web_img'], $fileName, $directoryPath);
            }

            if (empty($data['banner_image_mobile']) && $data['old_mob_img'] != "") {
                $fileName = $data['banner_name'] . '-mobile';
                $directoryPath = 'assetlite/images/banner/product_details';
                $data['banner_image_mobile'] = $this->rename($data['old_mob_img'], $fileName, $directoryPath);
            }
        }

        unset($data['old_banner_name']);
        unset($data['old_web_img']);
        unset($data['old_mob_img']);
//        dd($data);

        $section->update($data);
        return Response('Section updated successfully');
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
        if (request()->hasFile('image')) {
            $data['image'] = $this->upload($data['image'], 'assetlite/images/app-service/product-details');
        }
        $data['tab_type'] = $tab_type;
        $data['product_id'] = $product_id;
        $findFixedSection = $this->appServiceProductDetailsRepository->checkFixedSection($product_id);

        if (!$findFixedSection) {
            $this->save($data);
        } else {
            if (!isset($data['other_attributes'])) {
                $data['other_attributes'] = null;
            }
            $this->deleteFile($findFixedSection['image']);
            $findFixedSection->update($data);
        }
        return Response('App Service Section Update Successfully');
    }

    public function sectionDestroy($sectionId)
    {
        $section = $this->findOne($sectionId);
        $components = $this->componentRepository->findByProperties(['section_details_id' => $sectionId]);
        foreach ($components as $component) {
            $component->delete();
        }
        $section->delete();
    }
}
