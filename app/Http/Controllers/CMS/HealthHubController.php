<?php

namespace App\Http\Controllers\CMS;

use App\Helpers\Helper;
use App\Http\Requests\MyblManageRequest;
use App\Repositories\MyblManageItemRepository;
use App\Services\FeedCategoryService;
use App\Services\FeedService;
use App\Services\HealthHubService;
use App\Services\MyblManageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class HealthHubController extends Controller
{
    /**
     * @var FeedCategoryService
     */
    private $feedCategoryService;
    /**
     * @var HealthHubService
     */
    private $healthHubService;
    /**
     * @var FeedService
     */
    private $feedService;

    /**
     * HealthHubController constructor.
     */
    public function __construct(
        FeedCategoryService $feedCategoryService,
        FeedService $feedService,
        HealthHubService $healthHubService
    ) {
        $this->feedCategoryService = $feedCategoryService;
        $this->feedService = $feedService;
        $this->healthHubService = $healthHubService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $orderBy = ['column' => 'display_order', 'direction' => 'ASC'];
        $healthHubItems = $this->healthHubService->findBy([], null, $orderBy);
        return view('admin.mybl-health-hub.index', compact('healthHubItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $actionList = Helper::navigationActionList();
        $actionList["FEED_CATEGORY"] = "Feed Category";
        $actionList["FEED_CATEGORY_POST"] = "Feed Category Post";
        return view('admin.mybl-health-hub.create', compact('actionList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return false|string
     */
    public function getFeedsData($catSlug = null)
    {
        return $this->feedCategoryService->getFeedForDropDown($catSlug);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MyblManageRequest $request
     * @return Application|Redirector
     */
    public function store(Request $request)
    {
        $response = $this->healthHubService->storeHealthHub($request->all());
        Session::flash('success', $response->getContent());
        return redirect(route('health-hub.index'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function itemSortable(Request $request)
    {
        return $this->healthHubService->itemTableSort($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $healthHub = $this->healthHubService->findOrFail($id);
        $actionList = Helper::navigationActionList();
        $actionList["FEED_CATEGORY"] = "Feed Category";
        $actionList["FEED_CATEGORY_POST"] = "Feed Category Post";
        $feedCategories = $this->feedCategoryService->findAll();

        $feedPosts = [];
        if (isset($healthHub->other_info['feed_post_id'])) {
            $feedCatId = $this->feedCategoryService->findOneByCatSlug($healthHub->other_info['feed_cat_slug'])->id;
            $feedPosts = $this->feedService->findBy(['category_id' => $feedCatId]);
        }

        return view(
            'admin.mybl-health-hub.edit',
            compact(
                'healthHub',
                'actionList',
                'feedCategories',
                'feedPosts'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MyblManageRequest $request
     * @param int $id
     * @return Application|Redirector
     */
    public function update(Request $request, $id)
    {
        $response = $this->healthHubService->updateHealthHub($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect(route('health-hub.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|string
     */
    public function destroy($id)
    {
        $this->healthHubService->deleteHealthHubItem($id);
        return url(route('health-hub.index'));
    }
}
