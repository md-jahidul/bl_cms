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
                $q->select('id', 'name_en');
            },
            'appServiceCat' => function ($q) {
                $q->select('id', 'title_en');
            }
        ]);
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
        $appServiceCat = $this->findOne($id);
        if (request()->hasFile('product_img_url')) {
            $data['product_img_url'] = $this->upload($data['product_img_url'], 'assetlite/images/app-service/product');
            $this->deleteFile($appServiceCat->product_img_url);
        }

        // Check App & VAS
        if ($data['app_service_tab_id'] != 1 || $data['app_service_tab_id'] != 2) {
            $data['product_img_url'] = null;
            $this->deleteFile($appServiceCat->product_img_url);
        }

        $appServiceCat->update($data);
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
