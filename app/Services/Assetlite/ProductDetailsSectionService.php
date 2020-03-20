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
