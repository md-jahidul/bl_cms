<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\MyblManageRequest;
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
     * MyblAppMenuController constructor.
     */
    public function __construct(
        MyblManageService $manageService
    ) {
        $this->manageService = $manageService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $orderBy = ['column' => 'display_order', 'direction' => 'ASC'];
        $manageCategories = $this->manageService->findAll(null, null, $orderBy);
        return view('admin.mybl-manage.categories.index', compact('manageCategories'));
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
     * Store a newly created resource in storage.
     *
     * @param MyblManageRequest $request
     * @return Application|Redirector
     */
    public function store(MyblManageRequest $request)
    {
        $response = $this->menuService->storeCategory($request->all());
        Session::flash('success', $response->getContent());
        return redirect(route('manage-category.index'));
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function parentMenuSortable(Request $request)
    {
        return $this->menuService->tableSort($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $menu = $this->menuService->findOrFail($id);
        return view('admin.mybl-menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MyblAppMenuRequest $request
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function update(MyblAppMenuRequest $request, $id)
    {
        $parentId =  $request->parent_id;
        $response = $this->menuService->updateMenu($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect(($parentId != 0) ? "mybl-menu/$parentId/child-menu" : 'mybl-menu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|string|UrlGenerator
     */
    public function destroy($parentId, $id)
    {
        $this->menuService->deleteMenu($id);
        return ($parentId == 0) ? url('mybl-menu') : url("mybl-menu/" . $parentId . "/child-menu");
    }
}
