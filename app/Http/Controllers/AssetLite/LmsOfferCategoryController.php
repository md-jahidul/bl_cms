<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\LmsOfferCategoryRequest;
use App\Http\Requests\StoreSliderRequest;
use App\Services\AlSliderService;
use App\Services\AlSliderComponentTypeService;
use App\Services\LmsOfferCategoryService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class LmsOfferCategoryController extends Controller
{
    /**
     * @var LmsOfferCategoryService
     */
    private $lmsOfferCategoryService;

    /**
     * LmsOfferCategoryController constructor.
     * @param LmsOfferCategoryService $lmsOfferCategoryService
     */
    public function __construct(LmsOfferCategoryService $lmsOfferCategoryService)
    {
        $this->lmsOfferCategoryService = $lmsOfferCategoryService;
    }

    /**
     * @return Factory|View
     */

    /**
     * @return Factory|View
     */
    public function index()
    {
        $lmsCategories = $this->lmsOfferCategoryService->findAll();
        return view('admin.loyalty.lms-categories.index', compact('lmsCategories'));
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.loyalty.lms-categories.create');
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(LmsOfferCategoryRequest $request)
    {
        $response = $this->lmsOfferCategoryService->storeLmsOfferCat($request->all());
        Session::flash('message', $response->getContent());
        return redirect('/las-offer-category');
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $lmsCategory = $this->lmsOfferCategoryService->findOne($id);
        return view('admin.loyalty.lms-categories.create', compact('lmsCategory'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public function update(LmsOfferCategoryRequest $request, $id)
    {
        $response = $this->lmsOfferCategoryService->updateSlider($request->all(), $request->id);
        Session::flash('message', $response->getContent());
        return redirect((strpos($request->previous_url, 'about-slider') !== false) ? $request->previous_url : url("/$sliderType-sliders"));
    }

    /**
     * @param $id
     * @return RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy($id)
    {
        $response = $this->lmsOfferCategoryService->deleteLmsOfferCat($id);
        Session::flash('message', $response->getContent());
        return url('/las-offer-category');
    }
}
