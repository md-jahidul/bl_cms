<?php

namespace App\Http\Controllers\CMS;

use App\Helpers\Helper;
use App\Http\Requests\MyblManageRequest;
use App\Repositories\MyblManageItemRepository;
use App\Services\FeedCategoryService;
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
     * HealthHubController constructor.
     */
    public function __construct(
        FeedCategoryService $feedCategoryService,
        HealthHubService $healthHubService
    ) {
        $this->feedCategoryService = $feedCategoryService;
        $this->healthHubService = $healthHubService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $orderBy = ['column' => 'display_order', 'direction' => 'DESC'];
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
     * Store a newly created resource in storage.
     *
     * @param MyblManageRequest $request
     * @return Application|Redirector
     */
    public function storeItem(Request $request, $parent_id)
    {
        $response = $this->manageService->storeItem($request->all());
        Session::flash('success', $response->getContent());
        return redirect(route("mybl-manage-items.index", $parent_id));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function categorySortable(Request $request)
    {
        return $this->manageService->tableSort($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function itemSortable(Request $request)
    {
        return $this->manageService->itemTableSort($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $category = $this->manageService->findOrFail($id);
        return view('admin.mybl-manage.categories.edit', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function editItem($parent_id, $id)
    {
        $manageCategory = $this->manageService->findOne($parent_id);
        $item = $this->manageItemRepository->findOrFail($id);
        $deeplinkActions = Helper::deepLinkList();
        $actionList = Helper::navigationActionList();
        return view('admin.mybl-manage.edit', compact('item', 'manageCategory', 'deeplinkActions', 'actionList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MyblManageRequest $request
     * @param int $id
     * @return Application|Redirector
     */
    public function update(MyblManageRequest $request, $id)
    {
        $response = $this->manageService->updateCategory($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect(route('manage-category.index'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MyblManageRequest $request
     * @param int $id
     * @return Application|Redirector
     */
    public function updateItem(Request $request, $parent_id, $id)
    {
        $response = $this->manageService->updateItem($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect(route("mybl-manage-items.index", $parent_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|string
     */
    public function destroy($id)
    {
        $this->manageService->deleteCategory($id);
        return url(route('manage-category.index'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|string
     */
    public function destroyItem($parent_id, $id)
    {
        $this->manageService->deleteItem($id);
        return url(route("mybl-manage-items.index", $parent_id));
    }
}
