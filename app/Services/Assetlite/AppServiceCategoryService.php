<?php

namespace App\Services\AssetLite;

use App\Repositories\AppServiceCategoryRepository;

use App\Traits\CrudTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class AppServiceCategoryService
{
    use CrudTrait;

    /**
     * @var $menuRepository
     */
    protected $appServiceCategoryRepository;

    /**
     * AppServiceCategoryService constructor.
     * @param AppServiceCategoryRepository $appServiceCategoryRepository
     */
    public function __construct(AppServiceCategoryRepository $appServiceCategoryRepository)
    {
        $this->appServiceCategoryRepository = $appServiceCategoryRepository;
        $this->setActionRepository($appServiceCategoryRepository);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeAppServiceCat($data)
    {
        $data['alias'] = str_replace(' ', '_', strtolower($data['title_en']));
        $this->save($data);
        return new Response('App Service Category added successfully');
    }

    /**
     * @param $data
     * @return Response
     */
    public function tableSort($data)
    {
        $this->appServiceCategoryRepository->menuTableSort($data);
        return new Response('App Service Category Sort successfully');
    }

    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updateAppServiceCat($data, $id)
    {
        $appServiceCat = $this->findOne($id);
        $appServiceCat->update($data);
        return Response('App Service Category updated successfully');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function deleteAppServiceCat($id)
    {
        $appServiceCat = $this->findOne($id);
        $appServiceCat->delete();
        return Response('App Service Tab deleted successfully !');
    }
}
