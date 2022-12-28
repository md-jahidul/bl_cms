<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Services\AdTechService;
use App\Services\SearchService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;


class SearchController extends Controller
{

    private $searchService;
    private $adTechService;

    /**
     * SearchController constructor.
     * @param SearchService $searchService
     */
    public function __construct(SearchService $searchService, AdTechService $adTechService) {
        $this->searchService = $searchService;
        $this->adTechService = $adTechService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $type
     * @return Application|Factory|View
     * @Bulbul Mahmud Nito || 11/03/2020
     */
    public function index()
    {
        $settings = $this->searchService->getSettingData();
        $popular = $this->searchService->getPopularSearch();
        $adTech = $this->adTechService->getAdTechByRefType('search_modal');
        return view('admin.search.index', compact('settings', 'popular', 'adTech'));
    }

    /**
     * Update search setting limit
     *
     * @param Request $request
     * @return Response
     * @Bulbul Mahmud Nito || 11/03/2020
     */
    public function saveLimit(Request $request)
    {
        return $this->searchService->updateSearchLimit($request);
    }

    /**
     * Popular search create form
     *
     * @param NO
     * @return Factory|View
     * @Bulbul Mahmud Nito || 11/03/2020
     */
    public function popularSearchCreate()
    {
        return view('admin.search.create');
    }

    /**
     * save Popular search
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     * @Bulbul Mahmud Nito || 11/03/2020
     */
    public function popularSearchSave(Request $request)
    {
        $response = $this->searchService->savePopularSearch($request);
        if ($response['success'] == 1) {
            Session::flash('sussess', 'Keyword is saved!');
        } else {
            Session::flash('error', 'Keyword saving process failed!');
        }
        return redirect('/popular-search');
    }

    /**
     * Popular search edit form
     *
     * @param NO
     * @return Factory|View
     * @Bulbul Mahmud Nito || 12/03/2020
     */
    public function popularSearchEdit($kwId)
    {
        $popularSearch = $this->searchService->popularSearchById($kwId);
        $products = $this->searchService->offerWiseProducts($popularSearch->type);
        return view('admin.search.edit', compact('popularSearch', 'products'));
    }

    /**
     * Popular search update
     *
     * @param NO
     * @return Factory|View
     * @Bulbul Mahmud Nito || 12/03/2020
     */
    public function popularSearchUpdate(Request $request)
    {
        $response = $this->searchService->updatePopularSearch($request);
        if ($response['success'] == 1) {
            Session::flash('sussess', 'Keyword is updated!');
        } else {
            Session::flash('error', 'Keyword updating process failed!');
        }

        return redirect('/popular-search');
    }

    /**
     * Keyword Sorting Change.
     *
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 20/03/2020
     */
    public function popularSortChange(Request $request)
    {
        $sortChange = $this->searchService->changeKeywordSort($request);
        return $sortChange;
    }

    /**
     * delete Popular search
     *
     * @param $kwId
     * @return Redirect
     * @Bulbul Mahmud Nito || 11/03/2020
     */
    public function deletePopularSearch($kwId)
    {
        $response = $this->searchService->deletePopularSearch($kwId);

        if ($response['success'] == 1) {
            Session::flash('sussess', 'Keyword is deleted!');
        } else {
            Session::flash('error', 'Keyword deleting process failed!');
        }

        return redirect('/popular-search');
    }

    /**
     * Get product list by type
     *
     * @param NO
     * @return $response
     * @Bulbul Mahmud Nito || 11/03/2020
     */
    public function getProductList(Request $request)
    {
        $products = $this->searchService->getProducts($request);
        return $products;
    }

    /**
     * Change status of popular search
     *
     * @param $kwId
     * @return $response
     * @Bulbul Mahmud Nito || 12/03/2020
     */
    public function popularSearchStatus($kwId)
    {
        $products = $this->searchService->popularSearchStatusChange($kwId);
        return $products;
    }

    public function adTechStore(Request $request)
    {
        $request->validate([
            'status' => 'required',
        ]);
        
        $response = $this->adTechService->storeAdTech($request->all(), 'search_modal');
        Session::flash('message', $response->getContent());
        return redirect('popular-search');
    }

}
