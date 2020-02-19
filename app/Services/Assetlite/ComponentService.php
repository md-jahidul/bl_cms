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
            unset($data['image_url']);
        }

        $data['page_type'] = self::APP;

        $this->save($data);
        return new Response('App Service Component added successfully');
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
