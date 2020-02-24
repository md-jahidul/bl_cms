<?php

namespace App\Http\Controllers\AssetLite;

use App\Repositories\AppServiceCategoryRepository;
use App\Repositories\AppServiceTabRepository;
use App\Services\AppServiceCategoryService;
use App\Services\AppServiceProductService;
use App\Services\AppServiceTabService;
use App\Services\TagCategoryService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AppServiceProductController extends Controller
{
    /**
     * @var $appServiceCategoryRepository
     */
    private $appServiceCategoryRepository;
    /**
     * @var $appServiceTabRepository
     */
    private $appServiceTabRepository;
    /**
     * @var $appServiceProductService
     */
    private $appServiceProductService;

    /**
     * @var $tagCategoryService
     */
    private $tagCategoryService;


    public function __construct(
        AppServiceTabRepository $appServiceTabRepository,
        AppServiceCategoryRepository $appServiceCategoryRepository,
        AppServiceProductService $appServiceProductService,
        TagCategoryService $tagCategoryService
    ) {
        $this->appServiceCategoryRepository = $appServiceCategoryRepository;
        $this->appServiceTabRepository = $appServiceTabRepository;
        $this->appServiceProductService = $appServiceProductService;
        $this->tagCategoryService = $tagCategoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $appServiceProduct = $this->appServiceProductService->productList();
        return view('admin.app-service.product.index', compact('appServiceProduct'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $appServiceTabs = $this->appServiceTabRepository->findByProperties(array(), ['id', 'name_en', 'alias']);
        $tags = $this->tagCategoryService->findAll();
        return view('admin.app-service.product.create', compact('tags', 'appServiceTabs', 'appServiceCat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $response = $this->appServiceProductService->storeAppServiceProduct($request->all());
        Session::flash('message', $response->getContent());
        return redirect(route('app-service-product.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $appServiceTabs = $this->appServiceTabRepository->findByProperties(array(), ['id', 'name_en', 'alias']);
        $appServiceProduct = $this->appServiceProductService->findOne($id, ['appServiceTab' => function ($q) {
            $q->select('id', 'name_en', 'alias');
        }]);

        $appServiceCategory = $this->appServiceCategoryRepository
            ->findByProperties(
                ['app_service_tab_id' => $appServiceProduct->app_service_tab_id],
                ['id', 'title_en', 'alias']
            );
//        return $appServiceProduct;
        $tags = $this->tagCategoryService->findAll();
        return view('admin.app-service.product.edit', compact(
            'tags',
            'appServiceTabs',
            'appServiceCat',
            'appServiceProduct',
            'appServiceCategory'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $response = $this->appServiceProductService->updateAppServiceProduct($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect(route('app-service-product.index'));
    }

    public function tabWiseCategory($tabId)
    {
        return $this->appServiceCategoryRepository
            ->findByProperties(['app_service_tab_id' => $tabId], ['id', 'title_en', 'alias']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $response = $this->appServiceProductService->deleteAppServiceProduct($id);
        Session::flash('message', $response->getContent());
        return route('tabs.index');
    }
}
