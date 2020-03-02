<?php

namespace App\Services;

//use App\Repositories\AppServiceProductegoryRepository;

use App\Repositories\AppServiceProductRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class AppServiceProductService
{
    use CrudTrait;
    use FileTrait;

    const APP = 1;
    const VAS = 2;

    /**
     * @var $appServiceProductRepository
     */
    protected $appServiceProductRepository;

    /**
     * AppServiceProductService constructor.
     * @param AppServiceProductRepository $appServiceProductRepository
     */
    public function __construct(AppServiceProductRepository $appServiceProductRepository)
    {
        $this->appServiceProductRepository = $appServiceProductRepository;
        $this->setActionRepository($appServiceProductRepository);
    }

    public function productList()
    {
        return $this->findAll('', [
            'appServiceTab' => function ($q) {
                $q->select('id', 'name_en', 'alias');
            },
            'appServiceCat' => function ($q) {
                $q->select('id', 'title_en');
            }
        ], ['column' => 'created_at', 'direction' => 'DESC']);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeAppServiceProduct($data)
    {
        if (request()->hasFile('product_img_url')) {
            $data['product_img_url'] = $this->upload($data['product_img_url'], 'assetlite/images/app-service/product');
        }
        $this->save($data);
        return new Response('App Service Category added successfully');
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
            $data['product_img_url'] = $this->upload($data['product_img_url'], 'assetlite/images/app-service/product');
            $this->deleteFile($appServiceProduct->product_img_url);
        }

//        // Check App & VAS
//        if ($data['app_service_tab_id'] !== self::APP || $data['app_service_tab_id'] !== self::VAS) {
//            $data['product_img_url'] = null;
//            $this->deleteFile($appServiceProduct->product_img_url);
//        }
        $data['can_active'] = (isset($data['can_active']) ? 1 : 0);
        $data['show_in_vas'] = (isset($data['show_in_vas']) ? 1 : 0);
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
        $appServiceProduct = $this->findOne($id);
        $this->deleteFile($appServiceProduct->product_img_url);
        $appServiceProduct->delete();
        return Response('App Service Product deleted successfully !');
    }

    public function appServiceRelatedProduct($tab_type, $product_id)
    {
        return $this->appServiceProductRepository->appServiceProduct($tab_type, $product_id);
    }

    public function detailsProduct($id)
    {
        return $this->appServiceProductRepository->findOne(['id' => $id]);
    }
}
