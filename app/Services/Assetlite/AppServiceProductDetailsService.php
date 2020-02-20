<?php

namespace App\Services\Assetlite;

//use App\Repositories\AppServiceProductegoryRepository;

use App\Repositories\AppServiceProductDetailsRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class AppServiceProductDetailsService
{
    use CrudTrait;
    use FileTrait;


    /**
     * @var $appServiceProductDetailsRepository
     */
    protected $appServiceProductDetailsRepository;
    /**
     * @var AppServiceProductDetailsRepository
     */

    /**
     * AppServiceProductService constructor.
     * @param AppServiceProductDetailsRepository $appServiceProductDetailsRepository
     */
    public function __construct(AppServiceProductDetailsRepository $appServiceProductDetailsRepository)
    {
        $this->appServiceProductDetailsRepository = $appServiceProductDetailsRepository;
        $this->setActionRepository($appServiceProductDetailsRepository);
    }

    public function sectionList($product_id)
    {
        $data = [];
        $data['section_body'] = $this->appServiceProductDetailsRepository->findSection($product_id);
        $data['fixed_section'] = $this->appServiceProductDetailsRepository->fixedSection($product_id);
        return $data;
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeAppServiceProductDetails($data, $tab_type, $product_id)
    {
        // if (request()->hasFile('product_img_url')) {
        //     $data['product_img_url'] = $this->upload($data['product_img_url'], 'assetlite/images/app-service/product');
        // }

        $data['product_id'] = $product_id;
        $data['tab_type'] = $tab_type;


        $this->save($data);
        return new Response('App Service details section added successfully');
    }

    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updateAppServiceDetailsSection($data, $id)
    {
        $appServiceProduct = $this->findOne($id);
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
//        $findSection = $this->appServiceProductDetailsRepository->findOneByProperties([
//            'category' => $data['category']
//        ]);

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
            $findFixedSection->update($data);
        }

        return Response('App Service Section Update Successfully');
    }
}
