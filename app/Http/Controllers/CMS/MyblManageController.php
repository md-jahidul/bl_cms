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
        $response = $this->manageService->storeCategory($request->all());
        Session::flash('success', $response->getContent());
        return redirect(route('manage-category.index'));
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
}
