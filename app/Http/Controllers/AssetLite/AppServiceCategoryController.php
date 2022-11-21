<?php

namespace App\Http\Controllers\AssetLite;

use App\Repositories\AppServiceTabRepository;
use App\Services\AppServiceCategoryService;
use App\Services\AppServiceTabService;
use Exception;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AppServiceCategoryController extends Controller
{
    /**
     * @var AppServiceCategoryService
     */
    private $appServiceCategory;
    /**
     * @var AppServiceTabService
     */
    private $appServiceTabRepository;

    /**
     * AppServiceCategoryController constructor.
     * @param AppServiceCategoryService $appServiceCategory
     * @param AppServiceTabRepository $appServiceTabRepository
     */
    public function __construct(
         $appServiceCategory,
        AppServiceTabRepository $appServiceTabRepository
    ) {
        $this->appServiceCategory = $appServiceCategory;
        $this->appServiceTabRepository = $appServiceTabRepository;
    }

    /**
     * Display a listing of the App Service Category.
     *
     * @return Factory|View
     */
    public function index()
    {
        $appServiceCat = $this->appServiceCategory->findAll('', ['appServiceTab'], [
                'column' => 'created_at',
                'direction' => 'DESC'
            ]);
        return view('admin.app-service.product-category.index', compact('appServiceCat'));
    }

    /**
     * Show the form for creating a new App Service Category.
     *
     * @return Factory|View
     */
    public function create()
    {
        $appServiceTabs = $this->appServiceTabRepository->findByProperties([], ['id', 'name_en', 'alias']);
        return view('admin.app-service.product-category.create', compact('appServiceTabs'));
    }

    /**
     * Store a newly created App Service Category in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $this->appServiceCategory->storeAppServiceCat($request->all());
        Session::flash('message', 'App Service Category Add successfully!');
        return redirect('app-service/category');
    }


    /**
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $appServiceTabs = $this->appServiceTabRepository->findByProperties([], ['id', 'name_en', 'alias']);
        $appServiceCat = $this->appServiceCategory->findOne($id);
//        return $appServiceCat;
        return view('admin.app-service.product-category.edit', compact('appServiceCat', 'appServiceTabs'));
    }

    /**
     * Update a App Service category items
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $this->appServiceCategory->updateAppServiceCat($request->all(), $id);
        Session::flash('message', 'App Service Category Update successfully!');
        return redirect('app-service/category');
    }

    /**
     * Delete a App Service category items
     *
     * @param $id
     * @return UrlGenerator|string
     * @throws Exception
     */
    public function destroy($id)
    {
        $this->appServiceCategory->deleteAppServiceCat($id);
        return url('app-service/category');
    }
}
