<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\MyblManageRequest;
use App\Repositories\MyblManageItemRepository;
use App\Services\MyblManageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class MyblManageController extends Controller
{
    /**
     * @var MyblManageService
     */
    private $manageService;
    /**
     * @var MyblManageItemRepository
     */
    private $manageItemRepository;

    /**
     * MyblAppMenuController constructor.
     */
    public function __construct(
        MyblManageService $manageService,
        MyblManageItemRepository $manageItemRepository
    ) {
        $this->manageService = $manageService;
        $this->manageItemRepository = $manageItemRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $orderBy = ['column' => 'display_order', 'direction' => 'ASC'];
        $manageCategories = $this->manageService->findAll(null, ['manageItems'], $orderBy);
        return view('admin.mybl-manage.categories.index', compact('manageCategories'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function manageItemsList($parent_id)
    {
        $manageItems = $this->manageService->itemList($parent_id);
        $parentMenu = $this->manageService->findOne($parent_id);
        return view('admin.mybl-manage.index', compact('manageItems', 'parentMenu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.mybl-manage.categories.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function createItem($parent_id)
    {
        $parentMenu = $this->manageService->findOne($parent_id);
        return view('admin.mybl-manage.create', compact('parent_id', 'parentMenu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MyblManageRequest $request
     * @return Application|Redirector
     */
    public function store(MyblManageRequest $request)
    {
        $response = $this->manageService->storeCategory($request->all());
        Session::flash('success', $response->getContent());
        return redirect(route('manage-category.index'));
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
//        dd($item);
        return view('admin.mybl-manage.edit', compact('item', 'manageCategory'));
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
